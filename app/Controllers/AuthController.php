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
        // Require admin role
        $adminId = roleId('admin') ?? 4;
        if ((int)$user['role_id'] !== (int)$adminId) {
            return redirect()->back()->with('error','Admin access required');
        }
        $session = session();
        $session->set([
            'user_id'   => $user['id'],
            'user_role' => 'admin',
            'logged_in' => true,
        ]);
        return redirect()->to('/admin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success','Logged out');
    }
}
