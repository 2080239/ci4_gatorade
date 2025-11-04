<?php
namespace App\Models;
use CodeIgniter\Model;

class AthleteModel extends Model
{
    protected $table = 'athletes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'team_id','first_name','middle_name','last_name','dob','phone','email',
        'parent_name','parent_email','parent_phone','is_reserve'
    ];
    protected $useTimestamps = false;
}
