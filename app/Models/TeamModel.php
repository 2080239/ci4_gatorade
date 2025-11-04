<?php
namespace App\Models;
use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id';
    protected $allowedFields = ['team_name','qualifier_city','division','document'];
    protected $useTimestamps = false;
}
