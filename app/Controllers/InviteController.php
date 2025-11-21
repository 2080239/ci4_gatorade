<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class InviteController extends Controller
{
    protected $userModel;
    protected $helpers = ['form','url'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // parent invitation page: /invite/parent?token=CODE&email=...
    public function parent()
    {
        $token = $this->request->getGet('token');
        $email = $this->request->getGet('email');
        $parentRoleId = roleId('parent') ?? 2;
        $user = $this->userModel
            ->where('role_id',$parentRoleId)
            ->where('invitation_code',$token)
            ->where('email',$email)
            ->first();
        if (!$user) return view('invite/invalid');
        if ($user['status'] === 'expired' || ($user['expiry_date'] && strtotime($user['expiry_date']) < time())) {
            $this->userModel->update($user['id'], ['status'=>'expired']);
            return view('invite/expired');
        }
        return view('invite/parent_step1', ['user'=>$user]); // set password
    }

    public function parentSubmit()
    {
        $post = $this->request->getPost();
        $parentRoleId = roleId('parent') ?? 2;
        $user = $this->userModel->where('role_id',$parentRoleId)->where('invitation_code',$post['token'])->first();
        if (!$user) return redirect()->to('/invite/invalid');

        $this->userModel->update($user['id'], [
            'password_hash'=>password_hash($post['password'], PASSWORD_DEFAULT),
            'invitation_consumed'=>1,
            'status'=>'active'
        ]);

        return redirect()->to('/invite/parent/profile?user_id='.$user['id']);
    }

    public function parentProfile()
    {
        $userId = $this->request->getGet('user_id');
        $user = $this->userModel->find($userId);
        return view('invite/parent_profile', ['user'=>$user]);
    }

    public function parentProfileSubmit()
    {
        $post = $this->request->getPost();
        $userId = $post['user_id'];

        $update = [
            'first_name'=>$post['first_name'] ?? null,
            'last_name'=>$post['last_name'] ?? null,
            'phone'=>$post['phone'] ?? null,
            'dob'=>$post['dob'] ?? null,
            'address_line1'=>$post['address_line1'] ?? null,
            'city'=>$post['city'] ?? null,
            'state'=>$post['state'] ?? null,
            'zip_code'=>$post['zip_code'] ?? null
        ];

        $file = $this->request->getFile('passport');
        if ($file && $file->isValid()) {
            $new = $file->getRandomName();
            $file->move(WRITEPATH.'uploads', $new);
            $update['documents_json'] = json_encode(['passport'=>$new]);
        }

        $update['status'] = 'completed';
        $this->userModel->update($userId, $update);

        return view('invite/parent_finish', ['user'=>$this->userModel->find($userId)]);
    }

    // Athlete flows mirror parent flows
    public function athlete()
    {
        $token = $this->request->getGet('token');
        $email = $this->request->getGet('email');
        $athleteRoleId = roleId('athlete') ?? 3;
        $user = $this->userModel
            ->where('role_id',$athleteRoleId)
            ->where('invitation_code',$token)
            ->where('email',$email)
            ->first();
        if (!$user) return view('invite/invalid');
        if ($user['status'] === 'expired' || ($user['expiry_date'] && strtotime($user['expiry_date']) < time())) {
            $this->userModel->update($user['id'], ['status'=>'expired']);
            return view('invite/expired');
        }
        return view('invite/athlete_step1', ['user'=>$user]);
    }

    public function athleteSubmit()
    {
        $post = $this->request->getPost();
        $athleteRoleId = roleId('athlete') ?? 3;
        $user = $this->userModel->where('role_id',$athleteRoleId)->where('invitation_code',$post['token'])->first();
        if (!$user) return redirect()->to('/invite/invalid');

        $this->userModel->update($user['id'], [
            'password_hash'=>password_hash($post['password'], PASSWORD_DEFAULT),
            'invitation_consumed'=>1,
            'status'=>'active'
        ]);

        return redirect()->to('/invite/athlete/profile?user_id='.$user['id']);
    }

    public function athleteProfile()
    {
        $userId = $this->request->getGet('user_id');
        $user = $this->userModel->find($userId);
        return view('invite/athlete_profile', ['user'=>$user]);
    }

    public function athleteProfileSubmit()
    {
        $post = $this->request->getPost();
        $userId = $post['user_id'];
        $update = [
            'first_name'=>$post['first_name'] ?? null,
            'last_name'=>$post['last_name'] ?? null,
            'dob'=>$post['dob'] ?? null,
            'phone'=>$post['phone'] ?? null,
            'address_line1'=>$post['address_line1'] ?? null,
            'city'=>$post['city'] ?? null,
            'state'=>$post['state'] ?? null,
            'zip_code'=>$post['zip_code'] ?? null
        ];

        $file = $this->request->getFile('passport');
        if ($file && $file->isValid()) {
            $new = $file->getRandomName();
            $file->move(WRITEPATH.'uploads', $new);
            $update['documents_json'] = json_encode(['passport'=>$new]);
        }

        $update['status'] = 'completed';
        $this->userModel->update($userId, $update);

        return view('invite/athlete_finish', ['user'=>$this->userModel->find($userId)]);
    }
}
