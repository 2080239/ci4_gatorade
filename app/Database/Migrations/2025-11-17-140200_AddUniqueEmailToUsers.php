<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUniqueEmailToUsers extends Migration
{
    public function up()
    {
        // Add unique index on email (will fail if duplicates exist)
        $this->db->query("ALTER TABLE users ADD UNIQUE INDEX uniq_users_email (email)");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE users DROP INDEX uniq_users_email");
    }
}
