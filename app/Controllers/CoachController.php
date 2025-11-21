<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class CoachController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        $coachId = $this->request->getGet('coach_id');
        if (!$coachId) {
            return redirect()->to('/register/coach/step1')->with('error', 'Missing coach ID.');
        }

        $coach = $this->userModel->find($coachId);
        if (!$coach) {
            return redirect()->to('/register/coach/step1')->with('error', 'Coach not found.');
        }

        // Basic stats derived from users table
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        // Total athletes linked to this coach
        $totalAthletes = (int)$builder->select('COUNT(*) as c')
            ->where('role_id', 3)
            ->where('coach_id', $coachId)
            ->get()->getRow('c');

        // Approved athletes: heuristic -> status='athlete_completed'
        $approvedAthletes = (int)$db->table('users')->select('COUNT(*) as c')
            ->where('role_id', 3)
            ->where('coach_id', $coachId)
            ->where('status', 'athlete_completed')
            ->get()->getRow('c');

        // Parents invited/accepted under this coach
        $totalParents = (int)$db->table('users')->select('COUNT(*) as c')
            ->where('role_id', 2)
            ->where('coach_id', $coachId)
            ->get()->getRow('c');

        $acceptedParents = (int)$db->table('users')->select('COUNT(*) as c')
            ->where('role_id', 2)
            ->where('coach_id', $coachId)
            ->whereIn('status', ['parent_profile_entered','parent_athlete_verified','parent_completed'])
            ->get()->getRow('c');

        // Waivers signed: heuristic -> parent_completed counts as signed
        $waiversSigned = (int)$db->table('users')->select('COUNT(*) as c')
            ->where('role_id', 2)
            ->where('coach_id', $coachId)
            ->where('status', 'parent_completed')
            ->get()->getRow('c');

        return view('coach/dashboard', [
            'coach'            => $coach,
            'coachId'          => $coachId,
            'totalAthletes'    => $totalAthletes,
            'approvedAthletes' => $approvedAthletes,
            'totalParents'     => $totalParents,
            'acceptedParents'  => $acceptedParents,
            'waiversSigned'    => $waiversSigned,
        ]);
    }
}
