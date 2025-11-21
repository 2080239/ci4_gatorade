<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        $athleteCount = $this->userModel->where('role_id', roleId('athlete') ?? 3)->countAllResults();
        $parentCount  = $this->userModel->where('role_id', roleId('parent') ?? 2)->countAllResults();
        $coachCount   = $this->userModel->where('role_id', roleId('coach') ?? 1)->countAllResults();
        return view('admin/dashboard',[
            'athleteCount'=>$athleteCount,
            'parentCount'=>$parentCount,
            'coachCount'=>$coachCount,
        ]);
    }
}
