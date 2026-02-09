<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeriodesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'periode' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('periodes', true);
    }

    public function down()
    {
        $this->forge->dropTable('periodes', true);
    }
}
