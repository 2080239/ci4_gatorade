<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'role_id' => ['type'=>'TINYINT','constraint'=>1,'default'=>3], // 1=Coach,2=Parent,3=Athlete

            // identity & auth
            'first_name' => ['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'middle_name' => ['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'last_name' => ['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'email' => ['type'=>'VARCHAR','constraint'=>191,'null'=>true],
            'password_hash' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],

            // codes, links & flags
            'activation_code' => ['type'=>'VARCHAR','constraint'=>16,'null'=>true],
            'invitation_code' => ['type'=>'VARCHAR','constraint'=>16,'null'=>true],
            'invitation_consumed' => ['type'=>'TINYINT','constraint'=>1,'default'=>0],
            'coach_id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'null'=>true],
            'linked_athlete_id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'null'=>true],
            'is_reserve' => ['type'=>'TINYINT','constraint'=>1,'default'=>0],

            // coach-only (team) fields
            'team_name' => ['type'=>'VARCHAR','constraint'=>150,'null'=>true],
            'qualifier_city' => ['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'division' => ['type'=>'VARCHAR','constraint'=>50,'null'=>true],

            // profile
            'phone' => ['type'=>'VARCHAR','constraint'=>30,'null'=>true],
            'dob' => ['type'=>'DATE','null'=>true],
            'address_line1' => ['type'=>'VARCHAR','constraint'=>191,'null'=>true],
            'address_line2' => ['type'=>'VARCHAR','constraint'=>191,'null'=>true],
            'city' => ['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'state' => ['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'zip_code' => ['type'=>'VARCHAR','constraint'=>20,'null'=>true],

            // documents & consents
            'documents_json' => ['type'=>'TEXT','null'=>true], // JSON list of uploaded filenames
            'consents_json' => ['type'=>'TEXT','null'=>true], // JSON of consent booleans

            // status & timing
            'status' => ['type'=>'VARCHAR','constraint'=>30,'default'=>'invited'],
            'expiry_date' => ['type'=>'DATETIME','null'=>true],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
