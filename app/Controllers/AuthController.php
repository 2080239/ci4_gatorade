<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;
    protected $helpers = ['form','url'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->loginPost();
        }
        return view('auth/login');
    }

    public function loginPost()
    {
        $email = trim($this->request->getPost('email') ?? '');
        $pass  = $this->request->getPost('password') ?? '';
        if ($email === '' || $pass === '') {
            return redirect()->back()->with('error','Email and password required');
        }
        $user = $this->userModel->where('email',$email)->first();
        if (!$user || empty($user['password_hash']) || !password_verify($pass, $user['password_hash'])) {
            return redirect()->back()->with('error','Invalid credentials');
        }
        $session = session();
        $coachRoleId = roleId('coach') ?? 1;
        $adminRoleId = roleId('admin') ?? 4;

        // Admin path remains unchanged
        if ((int)$user['role_id'] === (int)$adminRoleId) {
            $session->set([
                'user_id'   => $user['id'],
                'user_role' => 'admin',
                'logged_in' => true,
            ]);
            return redirect()->to('/admin');
        }

        // Coach login flow resume logic
        if ((int)$user['role_id'] === (int)$coachRoleId) {
            $session->set([
                'user_id'   => $user['id'],
                'coach_id'  => $user['id'],
                'user_role' => 'coach',
                'logged_in' => true,
            ]);

            $status = $user['status'] ?? '';
            if ($status === 'roster_entered' || $status === 'completed') {
                return redirect()->to('/coach/dashboard?coach_id='.$user['id']);
            }
            if ($status === 'profile_entered') {
                return redirect()->to('/coach/step3?coach_id='.$user['id']);
            }
            // Default start point
            return redirect()->to('/coach/step2?coach_id='.$user['id']);
        }

        // Other roles not permitted for this login form
        return redirect()->back()->with('error','Access restricted for this user type');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success','Logged out');
    }
}
