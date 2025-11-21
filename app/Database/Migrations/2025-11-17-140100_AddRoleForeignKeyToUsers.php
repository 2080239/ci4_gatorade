<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleForeignKeyToUsers extends Migration
{
    public function up()
    {
        // Add index first if not exists
        $this->db->query("ALTER TABLE users ADD INDEX idx_role_id (role_id)");
        // Add foreign key constraint
        $this->db->query("ALTER TABLE users\n            ADD CONSTRAINT fk_users_roles\n            FOREIGN KEY (role_id) REFERENCES roles(id)\n            ON UPDATE CASCADE ON DELETE RESTRICT");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE users DROP FOREIGN KEY fk_users_roles");
        $this->db->query("ALTER TABLE users DROP INDEX idx_role_id");
    }
}
