<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'role_id','first_name','middle_name','last_name','email','password_hash',
        'activation_code','invitation_code','invitation_consumed','coach_id','linked_athlete_id','is_reserve',
        'team_name','qualifier_city','division','phone','dob','address_line1','address_line2','city','state','zip_code',
        'documents_json','consents_json','status','expiry_date'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
