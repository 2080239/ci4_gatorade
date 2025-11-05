<?php
namespace App\Controllers;

use App\Models\AdminModel;

class AuthController extends BaseController
{
    public function login()
    {
        helper(['form', 'url']);
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $email = trim((string) $this->request->getPost('email'));
            $password = (string) $this->request->getPost('password');

            if ($email === '' || $password === '') {
                $data['error'] = 'Email and password are required.';
            } else {
                $adminModel = new AdminModel();
                $admin = $adminModel->where('email', $email)->first();

                if (!$admin || empty($admin['password_hash']) || !password_verify($password, $admin['password_hash'])) {
                    $data['error'] = 'Invalid credentials.';
                } elseif (array_key_exists('is_active', $admin) && (int) $admin['is_active'] === 0) {
                    $data['error'] = 'Account is inactive.';
                } else {
                    session()->set([
                        'user_id'    => $admin['id'],
                        'user_role'  => 'admin',
                        'isLoggedIn' => true,
                        'admin_email'=> $admin['email'],
                        'admin_name' => $admin['name'] ?? null,
                    ]);

                    return redirect()->to('/register/all');
                }
            }
        }

        echo view('layouts/header', ['title' => 'Admin Login', 'currentStep' => 0]);
        echo view('auth/login', $data);
        echo view('layouts/footer');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')
            ->with('success', 'Logged out.');
    }
}
