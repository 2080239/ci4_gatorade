<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Config\Services;

class RegisterController extends Controller
{
    protected $userModel;
    protected $helpers = ['form','url'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // show role select (optional)
    public function index()
    {
        return view('register/role_select');
    }

    // Coach Step1 - create coach with activation code
    public function coachStep1()
    {
        return view('register/coach_step1');
    }

    public function coachStep1Submit()
    {
        
        $role = strtolower(trim($this->request->getPost('role') ?? 'coach'));
      
        $lookupSlug = $role === 'player' ? 'athlete' : $role; 
        $roleId = roleId($lookupSlug) ?? roleId('coach') ?? 1;

        // Create draft record; details collected in subsequent steps.
        $id = $this->userModel->insert([
            'role_id' => $roleId,
            'status'  => 'started'
        ]);

        if (!$id) {
            return redirect()->back()->with('error', 'Unable to create registration record');
        }

        // Redirect to appropriate flow based on selection
        if ($lookupSlug === 'parent') {
            return redirect()->to('/register/parent/step1');
        } elseif ($lookupSlug === 'athlete') {
            return redirect()->to('/register/athlete/step1');
        } else {
            return redirect()->to('/register/coach/step2?coach_id='.$id);
        }
    }

    // Coach Step2: team details
    public function coachStep2()
    {
        $coachId = $this->request->getGet('coach_id');
        if (!$coachId) {
            return redirect()->to('/register/coach/step1')->with('error','Missing coach ID. Start at step 1.');
        }
        $coach = $this->userModel->find($coachId);
        if (!$coach) {
            return redirect()->to('/register/coach/step1')->with('error','Coach record not found. Please restart.');
        }
        return view('register/coach_step2', ['coach'=>$coach, 'coachId'=>$coachId]);
    }

    public function coachStep2Submit()
    {
        $post = $this->request->getPost();

        // Validation for the personal/profile fields collected on step2
        $rules = [
            'coach_id'       => 'required|is_natural_no_zero',
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|valid_email',
            'password'       => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'dob'            => 'required',
            'phone'          => 'required',
            'address_line1'  => 'required',
            'city'           => 'required',
            'state'          => 'required',
            'zip_code'       => 'required'
        ];

        if (!$this->validate($rules)) {
            $coach = $this->userModel->find($post['coach_id'] ?? 0);
            return view('register/coach_step2', [
                'coach'      => $coach,
                'coachId'    => $post['coach_id'] ?? null,
                'validation' => $this->validator,
                'error'      => 'Please correct the highlighted errors.'
            ]);
        }

        // Build update payload (NULL for optional fields if missing)
        $update = [
            'first_name'     => $post['first_name'],
            'middle_name'    => $post['middle_name'] ?? null,
            'last_name'      => $post['last_name'],
            'email'          => $post['email'],
            'dob'            => $post['dob'],
            'phone'          => $post['phone'],
            'address_line1'  => $post['address_line1'],
            'address_line2'  => $post['address_line2'] ?? null,
            'city'           => $post['city'],
            'state'          => $post['state'],
            'zip_code'       => $post['zip_code'],
        ];

        if (!empty($post['password'])) {
            $update['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }
        if (!empty($post['activation_code'])) {
            $update['activation_code'] = strtoupper(trim($post['activation_code']));
        }

        // Mark profile entered
        $update['status'] = 'profile_entered';
        $this->userModel->update($post['coach_id'], $update);

        // Always proceed to roster building after profile unless already fully completed
        $coach = $this->userModel->find($post['coach_id']);
        if (!empty($coach['status']) && $coach['status'] === 'completed') {
            return redirect()->to('/register/coach/dashboard?coach_id='.$post['coach_id']);
        }
        return redirect()->to('/register/coach/step3?coach_id='.$post['coach_id']);
    }

    // Coach Step3: create roster (athlete + parent rows) and send invites
    public function coachStep3()
    {
        $coachId = $this->request->getGet('coach_id');
        $coach = $this->userModel->find($coachId);
        $rosterExisting = [];
        if ($coachId) {
            $athleteRoleId = roleId('athlete') ?? 3;
            $parentRoleId  = roleId('parent') ?? 2;
            $athletes = $this->userModel->where('role_id',$athleteRoleId)->where('coach_id',$coachId)->orderBy('is_reserve','ASC')->findAll();
            $index = 0;
            foreach ($athletes as $ath) {
                if ($index >= 8) break; // limit to form slots
                $parent = $this->userModel->where('role_id',$parentRoleId)->where('coach_id',$coachId)->where('linked_athlete_id',$ath['id'])->first();
                $rosterExisting[$index] = [
                    'athlete_first' => $ath['first_name'] ?? '',
                    'athlete_middle'=> $ath['middle_name'] ?? '',
                    'athlete_last'  => $ath['last_name'] ?? '',
                    'athlete_dob'   => $ath['dob'] ?? '',
                    'athlete_phone' => $ath['phone'] ?? '',
                    'athlete_email' => $ath['email'] ?? '',
                    'parent_first'  => $parent['first_name'] ?? '',
                    'parent_email'  => $parent['email'] ?? '',
                    'parent_phone'  => $parent['phone'] ?? '',
                    'is_reserve'    => $ath['is_reserve'] ?? 0,
                ];
                $index++;
            }
        }
        return view('register/coach_step3', ['coach'=>$coach,'coachId'=>$coachId,'rosterExisting'=>$rosterExisting]);
    }

    public function coachStep3Submit()
    {
        $post = $this->request->getPost();
        $coachId = $post['coach_id'] ?? null;
        if (!$coachId) {
            return redirect()->back()->with('error','Missing coach ID');
        }
        // Persist team information (was previously not saved, causing NULL values)
        $teamUpdate = [];
        if (!empty($post['team_name'])) $teamUpdate['team_name'] = trim($post['team_name']);
        if (array_key_exists('qualifier_city',$post)) $teamUpdate['qualifier_city'] = trim($post['qualifier_city']) ?: null;
        if (array_key_exists('division',$post)) $teamUpdate['division'] = trim($post['division']) ?: null;
        if ($teamUpdate) {
            // Do not change status here; only store team data
            $this->userModel->update($coachId, $teamUpdate);
        }
        // roster_json built by JS; if absent, build from arrays as fallback
        $rosterJson = $post['roster_json'] ?? '';
        $roster = [];
        if ($rosterJson) {
            $decoded = json_decode($rosterJson, true);
            if (is_array($decoded)) {
                $roster = $decoded;
            }
        }
        if (!$roster) {
            $athleteFirst = $post['athlete_first_name'] ?? [];
            $athleteLast  = $post['athlete_last_name'] ?? [];
            $athleteEmail = $post['athlete_email'] ?? [];
            $athleteDob   = $post['athlete_dob'] ?? [];
            $athletePhone = $post['athlete_phone'] ?? [];
            $parentFirst  = $post['parent_name'] ?? [];
            $parentEmail  = $post['parent_email'] ?? [];
            $parentPhone  = $post['parent_phone'] ?? [];
            $count = max(count($athleteFirst), count($athleteLast), count($athleteEmail));
            for ($i=0;$i<$count;$i++) {
                $af = trim($athleteFirst[$i] ?? '');
                $al = trim($athleteLast[$i] ?? '');
                $ae = trim($athleteEmail[$i] ?? '');
                if (!$af && !$al && !$ae) continue;
                $roster[] = [
                    'athlete_first' => $af ?: null,
                    'athlete_last'  => $al ?: null,
                    'athlete_email' => $ae ?: null,
                    'athlete_dob'   => trim($athleteDob[$i] ?? '') ?: null,
                    'athlete_phone' => trim($athletePhone[$i] ?? '') ?: null,
                    'parent_first'  => trim($parentFirst[$i] ?? '') ?: null,
                    'parent_email'  => trim($parentEmail[$i] ?? '') ?: null,
                    'parent_phone'  => trim($parentPhone[$i] ?? '') ?: null,
                    'is_reserve'    => $i >= 6 ? 1 : 0
                ];
            }
        }
        if (!is_array($roster)) {
            return redirect()->back()->with('error','Invalid roster');
        }

        $minTs = strtotime('2009-05-31');
        $maxTs = strtotime('2011-11-01');
        foreach ($roster as $entry) {
            // Prepare athlete fields
            $athleteCode = $this->generateCode();
            $athleteRoleId = roleId('athlete') ?? 3;
            $athleteEmail = $entry['athlete_email'] ?? null;
            $existsAth = null;
            if (!empty($athleteEmail)) {
                $existsAth = $this->userModel->where('role_id',$athleteRoleId)->where('coach_id',$coachId)->where('email',$athleteEmail)->first();
            }
            if ($existsAth) {
                // Update missing dob/phone if not set previously
                $updateAth = [];
                if (!empty($entry['athlete_dob']) && empty($existsAth['dob'])) {
                    $updateAth['dob'] = $entry['athlete_dob'];
                }
                if (!empty($entry['athlete_phone']) && empty($existsAth['phone'])) {
                    $updateAth['phone'] = $entry['athlete_phone'];
                }
                if ($updateAth) {
                    $this->userModel->update($existsAth['id'], $updateAth);
                }
                $athleteId = $existsAth['id'];
            } else {
                // Validate DOB range if provided
                $dobVal = $entry['athlete_dob'] ?? null;
                if ($dobVal) {
                    $ts = strtotime($dobVal);
                    if (!$ts || $ts < $minTs || $ts > $maxTs) {
                        $dobVal = null; // discard invalid DOB
                    }
                }
                $athleteId = $this->userModel->insert([
                    'role_id'=>3,
                    'first_name'=>$entry['athlete_first'] ?? null,
                    'last_name'=>$entry['athlete_last'] ?? null,
                    'email'=>$athleteEmail,
                    'invitation_code'=>$athleteCode,
                    'coach_id'=>$coachId,
                    'is_reserve'=>!empty($entry['is_reserve'])?1:0,
                    'status'=>'invited',
                    'dob'=>$dobVal,
                    'phone'=>$entry['athlete_phone'] ?? null,
                    'expiry_date'=>date('Y-m-d H:i:s', strtotime('+14 days'))
                ]);
            }

            // Parent row
            $parentCode = $this->generateCode();
            $parentEmail = $entry['parent_email'] ?? null;
            $parentRoleId = roleId('parent') ?? 2;
            $existsParent = null;
            if (!empty($parentEmail) && $athleteId) {
                $existsParent = $this->userModel->where('role_id',$parentRoleId)->where('coach_id',$coachId)->where('linked_athlete_id',$athleteId)->where('email',$parentEmail)->first();
            }
            if ($existsParent) {
                $updateParent = [];
                if (!empty($entry['parent_phone']) && empty($existsParent['phone'])) {
                    $updateParent['phone'] = $entry['parent_phone'];
                }
                if ($updateParent) {
                    $this->userModel->update($existsParent['id'], $updateParent);
                }
            } else {
                $this->userModel->insert([
                    'role_id'=>2,
                    'first_name'=>$entry['parent_first'] ?? null,
                    'last_name'=>$entry['parent_last'] ?? null, // may be null (not collected yet)
                    'email'=>$parentEmail,
                    'invitation_code'=>$parentCode,
                    'coach_id'=>$coachId,
                    'linked_athlete_id'=>$athleteId,
                    'status'=>'invited',
                    'phone'=>$entry['parent_phone'] ?? null,
                    'expiry_date'=>date('Y-m-d H:i:s', strtotime('+14 days'))
                ]);
            }

            // send emails (try catch)
            $email = Services::email();
            $inviteA = base_url('invite/athlete?token='.urlencode($athleteCode).'&email='.urlencode($entry['athlete_email'] ?? ''));
            $inviteP = base_url('invite/parent?token='.urlencode($parentCode).'&email='.urlencode($entry['parent_email'] ?? ''));
            try {
                if (!empty($entry['athlete_email'])) {
                    $email->setFrom(getenv('app.emailFrom') ?: 'no-reply@gatorade.local','Gatorade 5V5');
                    $email->setTo($entry['athlete_email']);
                    $email->setSubject('You are invited as Athlete');
                    $email->setMessage("Register: {$inviteA}");
                    $email->send();
                }
                if (!empty($entry['parent_email'])) {
                    $email->setFrom(getenv('app.emailFrom') ?: 'no-reply@gatorade.local','Gatorade 5V5');
                    $email->setTo($entry['parent_email']);
                    $email->setSubject('You are invited as Parent');
                    $email->setMessage("Register: {$inviteP}");
                    $email->send();
                }
            } catch (\Exception $e) { /* ignore during dev */ }
        }

        // Determine if main roster (non-reserve) meets completion threshold (>=6 complete entries)
        $mainComplete = 0;
        foreach ($roster as $entry) {
            if (!empty($entry['is_reserve'])) continue;
            if (!empty($entry['athlete_first']) && !empty($entry['athlete_last']) && !empty($entry['athlete_email']) && !empty($entry['parent_first']) && !empty($entry['parent_email'])) {
                $mainComplete++;
            }
        }
        $saveExit = !empty($post['save_exit']);
        if ($mainComplete >= 6) {
            $this->userModel->update($coachId, ['status'=>'roster_entered']);
        } else {
            // Keep status at profile_entered for resume if roster not complete
            $current = $this->userModel->find($coachId);
            if (!empty($current) && ($current['status'] ?? '') === 'profile_entered') {
                // leave as is
            }
        }

        if ($saveExit) {
            // Optional: clear coach session id so login is required again
            if (session()->has('coach_id')) {
                session()->remove('coach_id');
            }
            return redirect()->to('/login')->with('message','Roster progress saved. Login later to resume Step 3.');
        }

        // If roster reached threshold go to uploads step, else reload step3 for further entries
        if ($mainComplete >= 6) {
            return redirect()->to('/register/coach/step4?coach_id='.$coachId);
        }
        return redirect()->to('/register/coach/step3?coach_id='.$coachId)->with('message','Partial roster saved. Add remaining athletes.');
    }

    // Coach Step4: uploads + finalize
    public function coachStep4()
    {
        $coachId = $this->request->getGet('coach_id');
        $coach = $this->userModel->find($coachId);
        return view('register/coach_step4', ['coach'=>$coach]);
    }

    public function coachStep4Submit()
    {
        $post = $this->request->getPost();
        $coachId = $post['coach_id'] ?? null;
        if (!$coachId) {
            return redirect()->back()->with('error','Missing coach ID');
        }

        $file = $this->request->getFile('coach_passport');
        if ($file && $file->isValid()) {
            $new = $file->getRandomName();
            $file->move(WRITEPATH.'uploads', $new);
            $this->userModel->update($coachId, ['documents_json'=>json_encode(['coach_passport'=>$new]), 'status'=>'completed']);
        } else {
            $this->userModel->update($coachId, ['status'=>'completed']);
        }

        // After completing step 4, redirect coach to their dashboard
        return redirect()->to('/coach/dashboard?coach_id='.$coachId);
    }

    // AJAX: send activation code (regenerate + email stub)
    public function sendActivationCode()
    {
        $coachId = $this->request->getPost('coach_id');
        if (!$coachId) {
            return $this->response->setJSON(['ok'=>false,'error'=>'Missing coach_id']);
        }
        $coach = $this->userModel->find($coachId);
        if (!$coach) {
            return $this->response->setJSON(['ok'=>false,'error'=>'Coach not found']);
        }
        $code = $this->generateCode(6);
        // Persist code if column exists; fallback to session if not
        $db = \Config\Database::connect();
        $fieldExists = $db->fieldExists('activation_code','users');
        if ($fieldExists) {
            $this->userModel->update($coachId, ['activation_code'=>$code, 'status'=>'code_sent']);
        } else {
            session()->set('activation_code_'.$coachId, $code);
        }
        // Email sending stub (optional - can be implemented later)
        return $this->response->setJSON(['ok'=>true,'message'=>'Code sent','code'=>$code]); // expose code for dev only
    }

    // AJAX: verify activation code
    public function activateCode()
    {
        $coachId = $this->request->getPost('coach_id');
        $input   = strtoupper(trim($this->request->getPost('activation_code') ?? ''));
        if (!$coachId || $input==='') {
            return $this->response->setJSON(['ok'=>false,'error'=>'Missing data']);
        }
        $coach = $this->userModel->find($coachId);
        if (!$coach) {
            return $this->response->setJSON(['ok'=>false,'error'=>'Coach not found']);
        }
        $db = \Config\Database::connect();
        $fieldExists = $db->fieldExists('activation_code','users');
        $stored = null;
        if ($fieldExists) {
            $stored = strtoupper($coach['activation_code'] ?? '');
        } else {
            $stored = strtoupper(session()->get('activation_code_'.$coachId) ?? '');
        }
        if ($stored === '' || $stored !== $input) {
            return $this->response->setJSON(['ok'=>false,'error'=>'Invalid activation code']);
        }
        if ($fieldExists) {
            $this->userModel->update($coachId, ['status'=>'activated']);
        } else {
            session()->set('activation_verified_'.$coachId, true);
        }
        return $this->response->setJSON(['ok'=>true,'message'=>'Code verified']);
    }

    // utility: create alphanumeric code length 8 (no ambiguous chars)
    private function generateCode($length=8)
    {
        $chars = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i=0;$i<$length;$i++) $code .= $chars[random_int(0, strlen($chars)-1)];
        return $code;
    }

    /* ===================== Parent Registration ===================== */
    public function parentStep1()
    {
        return view('register/parent_step1', ['currentStep'=>1]);
    }

    public function parentStep1Submit()
    {
        $email = trim($this->request->getPost('email') ?? '');
        $code  = trim($this->request->getPost('invitation_code') ?? '');
        if ($email === '' || $code === '') {
            return view('register/parent_step1', ['error'=>'Email and invitation code required','currentStep'=>1]);
        }
        $parentRoleId = roleId('parent') ?? 2;
        $parent = $this->userModel->where('role_id',$parentRoleId)->where('email',$email)->where('invitation_code',$code)->first();
        if (!$parent) {
            return view('register/parent_step1', ['error'=>'Invalid code or email','currentStep'=>1]);
        }
        // Check expiry
        if (!empty($parent['expiry_date']) && strtotime($parent['expiry_date']) < time()) {
            return view('register/parent_step1', ['error'=>'Invitation expired','currentStep'=>1]);
        }
        return redirect()->to('/register/parent/step2?parent_id='.$parent['id']);
    }

    public function parentStep2()
    {
        $id = $this->request->getGet('parent_id');
        $parent = $this->userModel->find($id);
        if (!$parent) return redirect()->to('/register/parent/step1')->with('error','Parent not found');
        return view('register/parent_step2', ['parent'=>$parent,'currentStep'=>2]);
    }

    public function parentStep2Submit()
    {
        $post = $this->request->getPost();
        $id = $post['parent_id'] ?? null;
        if (!$id) return redirect()->back()->with('error','Missing parent id');
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required'
        ];
        if (!$this->validate($rules)) {
            $parent = $this->userModel->find($id);
            return view('register/parent_step2', ['parent'=>$parent,'validation'=>$this->validator,'error'=>'Fix errors','currentStep'=>2]);
        }
        $update = [
            'first_name' => $post['first_name'],
            'middle_name' => $post['middle_name'] ?? null,
            'last_name' => $post['last_name'],
            'email' => $post['email'],
            'dob' => $post['dob'] ?? null,
            'phone' => $post['phone'] ?? null,
            'address_line1' => $post['address_line1'],
            'address_line2' => $post['address_line2'] ?? null,
            'city' => $post['city'],
            'state' => $post['state'],
            'zip_code' => $post['zip_code'],
            'status' => 'parent_profile_entered'
        ];
        $update['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);
        $this->userModel->update($id,$update);
        return redirect()->to('/register/parent/step3?parent_id='.$id);
    }

    public function parentStep3()
    {
        $id = $this->request->getGet('parent_id');
        $parent = $this->userModel->find($id);
        if (!$parent) return redirect()->to('/register/parent/step1');
        $athlete = null;
        if (!empty($parent['linked_athlete_id'])) {
            $athlete = $this->userModel->find($parent['linked_athlete_id']);
        }
        return view('register/parent_step3', ['parent'=>$parent,'athlete'=>$athlete,'currentStep'=>3]);
    }

    public function parentStep3Submit()
    {
        $post = $this->request->getPost();
        $id = $post['parent_id'] ?? null;
        if (!$id) return redirect()->back()->with('error','Missing parent id');
        // Optionally update athlete basic info
        if (!empty($post['athlete_id'])) {
            $aUpdate = [
                'first_name'=>$post['athlete_first_name'] ?? null,
                'last_name'=>$post['athlete_last_name'] ?? null,
                'dob'=>$post['athlete_dob'] ?? null
            ];
            $this->userModel->update($post['athlete_id'],$aUpdate);
        }
        $this->userModel->update($id,['status'=>'parent_athlete_verified']);
        return redirect()->to('/register/parent/step4?parent_id='.$id);
    }

    public function parentStep4()
    {
        $id = $this->request->getGet('parent_id');
        $parent = $this->userModel->find($id);
        if (!$parent) return redirect()->to('/register/parent/step1');
        return view('register/parent_step4', ['parent'=>$parent,'currentStep'=>4]);
    }

    public function parentStep4Submit()
    {
        $post = $this->request->getPost();
        $id = $post['parent_id'] ?? null;
        if (!$id) return redirect()->back()->with('error','Missing parent id');
        // Handle optional document upload (passport or photo)
        $file = $this->request->getFile('parent_doc');
        $docData = [];
        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move(WRITEPATH.'uploads',$name);
            $docData['parent_doc'] = $name;
        }
        $consents = [
            'waiver'=>!empty($post['consent_waiver']),
            'code_of_conduct'=>!empty($post['consent_code']),
            'marketing_email'=>!empty($post['marketing_email']),
            'marketing_sms'=>!empty($post['marketing_sms'])
        ];
        $update = [
            'status'=>'parent_completed'
        ];
        if ($docData) {
            $update['documents_json'] = json_encode($docData);
        }
        $update['consents_json'] = json_encode($consents);
        $this->userModel->update($id,$update);
        return redirect()->to('/register/parent/finish?parent_id='.$id);
    }

    public function parentFinish()
    {
        $id = $this->request->getGet('parent_id');
        $parent = $this->userModel->find($id);
        return view('register/parent_finish',['parent'=>$parent,'currentStep'=>4]);
    }

    /* ===================== Athlete Registration ===================== */
    public function athleteStep1()
    {
        return view('register/athlete_step1', ['currentStep'=>1]);
    }

    public function athleteStep1Submit()
    {
        $email = trim($this->request->getPost('email') ?? '');
        $code  = trim($this->request->getPost('invitation_code') ?? '');
        $fieldErrors = [];
        if ($email === '') {
            $fieldErrors['email'] = 'Email required';
        }
        if ($code === '') {
            $fieldErrors['invitation_code'] = 'Invitation code required';
        }
        if ($fieldErrors) {
            return view('register/athlete_step1', ['fieldErrors'=>$fieldErrors,'currentStep'=>1]);
        }
        $athleteRoleId = roleId('athlete') ?? 3;
        $athlete = $this->userModel->where('role_id',$athleteRoleId)->where('email',$email)->where('invitation_code',$code)->first();
        if (!$athlete) {
            $fieldErrors['invitation_code'] = 'Code or email incorrect';
            return view('register/athlete_step1', ['fieldErrors'=>$fieldErrors,'currentStep'=>1]);
        }
        if (!empty($athlete['expiry_date']) && strtotime($athlete['expiry_date']) < time()) {
            $fieldErrors['invitation_code'] = 'Invitation expired';
            return view('register/athlete_step1', ['fieldErrors'=>$fieldErrors,'currentStep'=>1]);
        }
        return redirect()->to('/register/athlete/step2?athlete_id='.$athlete['id']);
    }

    public function athleteStep2()
    {
        $id = $this->request->getGet('athlete_id');
        $athlete = $this->userModel->find($id);
        if (!$athlete) return redirect()->to('/register/athlete/step1');
        return view('register/athlete_step2',['athlete'=>$athlete,'currentStep'=>2]);
    }

    public function athleteStep2Submit()
    {
        $post = $this->request->getPost();
        $id = $post['athlete_id'] ?? null;
        if (!$id) return redirect()->back()->with('error','Missing athlete id');
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'dob' => 'required',
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required'
        ];
        if (!$this->validate($rules)) {
            $athlete = $this->userModel->find($id);
            return view('register/athlete_step2',['athlete'=>$athlete,'validation'=>$this->validator,'error'=>'Fix errors','currentStep'=>2]);
        }
        // Extra age range validation: DOB must be between 2009-05-31 and 2011-11-01 inclusive
        $dob = $post['dob'] ?? '';
        $min = strtotime('2009-05-31');
        $max = strtotime('2011-11-01');
        $dobTs = strtotime($dob);
        if (!$dobTs || $dobTs < $min || $dobTs > $max) {
            $athlete = $this->userModel->find($id);
            return view('register/athlete_step2',[ 'athlete'=>$athlete, 'error'=>'DOB must be between May 31, 2009 and Nov 1, 2011', 'currentStep'=>2]);
        }
        $update = [
            'first_name' => $post['first_name'],
            'middle_name' => $post['middle_name'] ?? null,
            'last_name' => $post['last_name'],
            'email' => $post['email'],
            'dob' => $post['dob'] ?? null,
            'phone' => $post['phone'] ?? null,
            'address_line1' => $post['address_line1'],
            'address_line2' => $post['address_line2'] ?? null,
            'city' => $post['city'],
            'state' => $post['state'],
            'zip_code' => $post['zip_code'],
            'status' => 'athlete_profile_entered'
        ];
        $update['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);
        $this->userModel->update($id,$update);
        return redirect()->to('/register/athlete/step3?athlete_id='.$id);
    }

    public function athleteStep3()
    {
        $id = $this->request->getGet('athlete_id');
        $athlete = $this->userModel->find($id);
        if (!$athlete) return redirect()->to('/register/athlete/step1');
        return view('register/athlete_step3',['athlete'=>$athlete,'currentStep'=>3]);
    }

    public function athleteStep3Submit()
    {
        $post = $this->request->getPost();
        $id = $post['athlete_id'] ?? null;
        if (!$id) return redirect()->back()->with('error','Missing athlete id');
        $file = $this->request->getFile('athlete_doc');
        $docData = [];
        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move(WRITEPATH.'uploads',$name);
            $docData['athlete_doc'] = $name;
        }
        $consents = [
            'waiver'=>!empty($post['consent_waiver']),
            'code_of_conduct'=>!empty($post['consent_code']),
            'marketing_email'=>!empty($post['marketing_email']),
            'marketing_sms'=>!empty($post['marketing_sms']),
            'parent_email'=>$post['parent_email'] ?? null
        ];
        $update = [
            'status'=>'athlete_completed'
        ];
        if ($docData) $update['documents_json'] = json_encode($docData);
        $update['consents_json'] = json_encode($consents);
        $this->userModel->update($id,$update);
        return redirect()->to('/register/athlete/finish?athlete_id='.$id);
    }

    public function athleteFinish()
    {
        $id = $this->request->getGet('athlete_id');
        $athlete = $this->userModel->find($id);
        return view('register/athlete_finish',['athlete'=>$athlete,'currentStep'=>3]);
    }
}
