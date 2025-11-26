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
        // Active tab from query (?tab=athletes etc.) with whitelist
        $activeTab = $this->request->getGet('tab') ?? 'dashboard';
        $allowedTabs = ['dashboard','athletes','parents','waivers','calendar','help'];
        if (! in_array($activeTab, $allowedTabs, true)) {
            $activeTab = 'dashboard';
        }

        $coachId = $this->request->getGet('coach_id');
        if (!$coachId && session()->has('coach_id')) {
            $coachId = session('coach_id');
        }
        if (!$coachId) {
            return redirect()->to('/login')->with('error', 'Missing coach ID.');
        }
        $coach = $this->userModel->find($coachId);
        if (!$coach) {
            return redirect()->to('/login')->with('error', 'Coach not found.');
        }
        // Enforce visibility only after roster is entered (or completed)
        $status = $coach['status'] ?? '';
        if ($status !== 'roster_entered' && $status !== 'completed') {
            if ($status === 'profile_entered') {
                return redirect()->to('/register/coach/step3?coach_id='.$coachId)->with('error','Complete roster before dashboard');
            }
            return redirect()->to('/register/coach/step2?coach_id='.$coachId)->with('error','Finish earlier steps first');
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

        // Athlete list (roster first then reserves) for table display
        $athletes = $db->table('users')
            ->select('id, first_name, last_name, email, status, invitation_code')
            ->where('role_id', 3)
            ->where('coach_id', $coachId)
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();

        // Parent list
        $parents = $db->table('users')
            ->select('id, first_name, last_name, email, status, invitation_code')
            ->where('role_id', 2)
            ->where('coach_id', $coachId)
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();

        // Queue position heuristic: rank based on number of completed coaches before this one.
        $queueTotal = (int)$db->table('users')->select('COUNT(*) as c')
            ->where('role_id', 1)
            ->get()->getRow('c');
        $completedBefore = (int)$db->table('users')->select('COUNT(*) as c')
            ->where('role_id', 1)
            ->where('status', 'completed')
            ->where('id <', $coachId) // simplistic ordering assumption
            ->get()->getRow('c');
        // If coach completed its roster, rank among completed; otherwise place after completed
        $queueRank = ($coach['status'] === 'completed') ? ($completedBefore + 1) : ($completedBefore + 1); // same formula for now


        // Waivers signed: heuristic -> parent_completed counts as signed
        $waiversSigned = (int)$db->table('users')->select('COUNT(*) as c')
            ->where('role_id', 2)
            ->where('coach_id', $coachId)
            ->where('status', 'parent_completed')
            ->get()->getRow('c');

        // Data guards / normalization
        $coach              = is_array($coach) ? $coach : [];
        $athletes           = is_array($athletes) ? $athletes : [];
        $parents            = is_array($parents) ? $parents : [];
        $totalAthletes      = (int)($totalAthletes ?? 0);
        $approvedAthletes   = (int)($approvedAthletes ?? 0);
        $totalParents       = (int)($totalParents ?? 0);
        $acceptedParents    = (int)($acceptedParents ?? 0);
        $waiversSigned      = (int)($waiversSigned ?? 0);
        $queueRank          = (int)($queueRank ?? 0);
        $queueTotal         = (int)($queueTotal ?? 0);
        if (! isset($coach['team_name'])) {
            log_message('warning', 'Coach dashboard missing team_name for coachId '.$coachId);
        }

        return view('coach/dashboard_page/dashboard', [
            'coach'            => $coach,
            'coachId'          => $coachId,
            'totalAthletes'    => $totalAthletes,
            'approvedAthletes' => $approvedAthletes,
            'totalParents'     => $totalParents,
            'acceptedParents'  => $acceptedParents,
            'waiversSigned'    => $waiversSigned,
            'athletes'         => $athletes,
            'parents'          => $parents,
            'queueRank'        => $queueRank,
            'queueTotal'       => $queueTotal,
            'activeTab'        => $activeTab,
        ]);
    }
}
