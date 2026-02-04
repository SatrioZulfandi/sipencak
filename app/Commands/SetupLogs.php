<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SetupLogs extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'setup:logs';
    protected $description = 'Creates the activity_logs table manually.';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        
        $sql = "CREATE TABLE IF NOT EXISTS activity_logs (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NULL,
            username VARCHAR(100) NOT NULL,
            role VARCHAR(50) NULL,
            action VARCHAR(50) NOT NULL,
            menu VARCHAR(50) NOT NULL,
            description TEXT NULL,
            ip_address VARCHAR(45) NOT NULL,
            created_at DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        try {
            $db->query($sql);
            CLI::write('Table activity_logs created successfully!', 'green');
        } catch (\Exception $e) {
            CLI::error('Error creating table: ' . $e->getMessage());
        }
    }
}
