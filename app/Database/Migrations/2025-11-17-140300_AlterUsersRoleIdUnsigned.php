<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersRoleIdUnsigned extends Migration
{
    public function up()
    {
        // Ensure role_id matches roles.id unsigned type
        $this->db->query("ALTER TABLE users MODIFY role_id TINYINT UNSIGNED NOT NULL DEFAULT 3");
    }

    public function down()
    {
        // Revert to previous signed tinyint (size not meaningful in MySQL)
        $this->db->query("ALTER TABLE users MODIFY role_id TINYINT NOT NULL DEFAULT 3");
    }
}
