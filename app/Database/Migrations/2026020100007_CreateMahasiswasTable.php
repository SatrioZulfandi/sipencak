<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMahasiswasTable extends Migration
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
            'id_pt' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_prodi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_pencairan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenjang' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'angkatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'pembaruan_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Tetap', 'Henti'],
                'default'    => 'Tetap',
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constraint' => ['Skema Pembiayaan Penuh', 'Skema Biaya Pendidikan'],
            ],
            'status_pengajuan' => [
                'type'       => 'ENUM',
                'constraint' => ['Belum Diajukan', 'Proses Pengajuan', 'Diajukan'],
                'default'    => 'Belum Diajukan',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('mahasiswas', true);
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswas', true);
    }
}
