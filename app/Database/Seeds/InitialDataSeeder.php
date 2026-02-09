<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Insert default Operator (LLDIKTI Admin)
        $this->db->table('users')->insert([
            'nama'       => 'Admin LLDIKTI',
            'username'   => 'admin',
            'password'   => password_hash('123456', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // 2. Insert default Periodes
        $this->db->table('periodes')->insertBatch([
            ['periode' => 'Semester Ganjil'],
            ['periode' => 'Semester Genap'],
        ]);

        echo "✅ Initial data seeded successfully!\n";
        echo "   - Admin user created (username: admin, password: 123456)\n";
        echo "   - 2 periode records created\n";
    }
}
