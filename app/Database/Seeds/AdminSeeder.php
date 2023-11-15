<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Administrator',
                'email' => 'admin@gmail.com',
                'status' => 'Active',
                'role' => 'Admin',
                'password' => password_hash('Admin.123', PASSWORD_DEFAULT)
            ],
        ];

        $this->db->table('tbl_user')->insertBatch($data);
    }
}
