<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Coach',   'slug' => 'coach',   'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'name' => 'Parent',  'slug' => 'parent',  'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'name' => 'Athlete', 'slug' => 'athlete', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'name' => 'Admin',   'slug' => 'admin',   'created_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('roles')->insertBatch($roles);
    }
}
