<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDocumentToTeams extends Migration
{
    public function up()
    {
        $fields = [
            'document' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'division',
            ],
        ];
        $this->forge->addColumn('teams', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('teams', 'document');
    }
}
