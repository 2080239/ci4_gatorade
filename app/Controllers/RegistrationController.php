<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\TeamModel;
use App\Models\CoachModel;
use App\Models\AthleteModel;

class RegistrationController extends BaseController
{
    public function step1()
    {
        helper('form');

        if ($this->request->getMethod() === 'post') {
            // assume step1 only collects "role"
            $role = $this->request->getPost('role');
            session()->set('reg.role', $role);
            return redirect()->to('/register/step2');
        }

        echo view('layouts/header', ['title'=>'Register - Step 1', 'currentStep' => 1]);
        echo view('registration/step1'); 
        echo view('layouts/footer');
    }

    public function step2()
    {
        helper('form');
        $data = [];

        if ($this->request->getMethod() === 'post') {
            // get fields from form
            $coach = [
                'first_name' => $this->request->getPost('first_name'),
                'middle_name'=> $this->request->getPost('middle_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'dob'        => $this->request->getPost('dob'),
                'phone'      => $this->request->getPost('phone'),
                'address1'   => $this->request->getPost('address1'),
                'address2'   => $this->request->getPost('address2'),
                'city'       => $this->request->getPost('city'),
                'state'      => $this->request->getPost('state'),
                'zip'        => $this->request->getPost('zip'),
                'email'      => $this->request->getPost('email'),
                'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];

            // simple validation example
            if (empty($coach['first_name']) || empty($coach['email'])) {
                $data['error'] = 'First name and email are required.';
            } else {
                session()->set('reg.coach', $coach);
                return redirect()->to('/register/step3');
            }
        }

        echo view('layouts/header', ['title'=>'Register - Step 2', 'currentStep' => 2]);
        echo view('registration/step2', $data);
        echo view('layouts/footer');
    }

    public function step3()
    {
        helper('form');
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $team = [
                'team_name'     => $this->request->getPost('team_name'),
                'qualifier_city'=> $this->request->getPost('qualifier_city'),
                'division'      => $this->request->getPost('division'),
            ];

            if (empty($team['team_name'])) {
                $data['error'] = 'Team name is required.';
            } else {
                session()->set('reg.team', $team);

               
                $athlete_firsts = $this->request->getPost('athlete_first_name');
                if ($athlete_firsts) {
                    $athletes = [];
                    foreach ($athlete_firsts as $i => $fname) {
                        $athletes[] = [
                            'first_name' => $fname,
                            'middle_name'=> $this->request->getPost('athlete_middle_name')[$i] ?? null,
                            'last_name'  => $this->request->getPost('athlete_last_name')[$i] ?? null,
                            'dob'        => $this->request->getPost('athlete_dob')[$i] ?? null,
                            'phone'      => $this->request->getPost('athlete_phone')[$i] ?? null,
                            'email'      => $this->request->getPost('athlete_email')[$i] ?? null,
                            'parent_name'=> $this->request->getPost('parent_name')[$i] ?? null,
                            'parent_email'=> $this->request->getPost('parent_email')[$i] ?? null,
                            'parent_phone'=> $this->request->getPost('parent_phone')[$i] ?? null,
                        ];
                    }
                    session()->set('reg.athletes', $athletes);
                }

                return redirect()->to('/register/step4');
            }
        }

        echo view('layouts/header', ['title'=>'Register - Step 3', 'currentStep' => 3]);
        echo view('registration/step3', $data);
        echo view('layouts/footer');
    }

    public function step4()
    {
        helper('form');
        $data = [];

        // require previous data
        $coach = session()->get('reg.coach');
        $team  = session()->get('reg.team');
        $athletes = session()->get('reg.athletes') ?? [];

        if (!$coach || !$team) {
            // missing previous steps — send to start
            return redirect()->to('/register/step1');
        }

        if ($this->request->getMethod() === 'post') {
            // optional: handle file input: <input type="file" name="document">
            $file = $this->request->getFile('document');
            if ($file && $file->isValid()) {
                $newName = $file->getRandomName();
               
                $uploadDir = FCPATH . 'uploads';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0775, true);
                }
                $file->move($uploadDir, $newName);
                
                $team['document'] = $newName;
                session()->set('reg.upload', $newName);
            }

            // persist to DB
            $teamModel = new TeamModel();
            $coachModel = new CoachModel();
            $athleteModel = new AthleteModel();

            $teamModel->insert($team);
            $teamId = $teamModel->getInsertID();

            // attach team id to coach and insert
            $coach['team_id'] = $teamId;
            $coachModel->insert($coach);

            foreach ($athletes as $a) {
                $a['team_id'] = $teamId;
                $athleteModel->insert($a);
            }

            // cleanup session
            session()->remove('reg');
            session()->setFlashdata('success', 'Registration completed successfully!');

            return redirect()->to('/register/complete');
        }

        // show confirmation page
        $data['coach'] = $coach;
        $data['team'] = $team;
        $data['athletes'] = $athletes;

        echo view('layouts/header', ['title'=>'Register - Step 4', 'currentStep' => 4]);
        echo view('registration/step4', $data);
        echo view('layouts/footer');
    }

    public function complete()
    {
        echo view('layouts/header', ['title'=>'Registration Complete', 'currentStep' => 0]);
        echo view('registration/complete');
        echo view('layouts/footer');
    }

    
    public function all()
    {
        
        if (session()->get('user_role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Please login as admin to continue.');
        }

        $teamModel = new TeamModel();
        $coachModel = new CoachModel();
        $athleteModel = new AthleteModel();

        $teams = $teamModel->orderBy('id', 'DESC')->findAll();

        $records = [];
        foreach ($teams as $t) {
            $coach = $coachModel->where('team_id', $t['id'])->first();
            $athletes = $athleteModel->where('team_id', $t['id'])->orderBy('id', 'ASC')->findAll();

            $records[] = [
                'team' => $t,
                'coach' => $coach,
                'athletes' => $athletes,
            ];
        }

        echo view('layouts/header', ['title' => 'All Registrations', 'currentStep' => 0]);
        echo view('registration/all', ['records' => $records]);
        echo view('layouts/footer');
    }
}
