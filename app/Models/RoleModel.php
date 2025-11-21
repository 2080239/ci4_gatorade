<?php namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table         = 'roles';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name','slug','created_at','updated_at'];
    protected $returnType    = 'array';
    protected $useTimestamps = true; // auto-manage created_at/updated_at if present
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
