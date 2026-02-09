<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        echo "=== SIPENCAK LLDIKTI Database Seeder ===\n\n";
        
        // Run InitialDataSeeder
        $this->call('InitialDataSeeder');
        
        echo "\n=== All seeders completed! ===\n";
        echo "\n📋 Default Login Credentials:\n";
        echo "   Role: Operator (LLDIKTI)\n";
        echo "   Username: admin\n";
        echo "   Password: 123456\n";
        echo "\n⚠️  IMPORTANT: Please change the password after first login!\n";
    }
}
