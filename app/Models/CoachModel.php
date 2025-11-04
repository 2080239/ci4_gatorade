<?php
namespace App\Models;
use CodeIgniter\Model;

class CoachModel extends Model
{
    protected $table = 'coaches';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'team_id','first_name','middle_name','last_name','dob','phone',
        'address1','address2','city','state','zip','email','password','activation_code'
    ];
    protected $useTimestamps = false;
}
