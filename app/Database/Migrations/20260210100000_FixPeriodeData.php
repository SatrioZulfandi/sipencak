<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixPeriodeData extends Migration
{
    public function up()
    {
        // Fix for when Semester is Genap but Periode says Semester Ganjil
        $this->db->query("UPDATE pencairans SET periode = 'Semester Genap' WHERE semester = 'Genap' AND periode = 'Semester Ganjil'");
        
        // Fix for when Semester is Ganjil but Periode says Semester Genap (just in case)
        $this->db->query("UPDATE pencairans SET periode = 'Semester Ganjil' WHERE semester = 'Ganjil' AND periode = 'Semester Genap'");
    }

    public function down()
    {
        // Irreversible data fix, nothing to do here.
    }
}
