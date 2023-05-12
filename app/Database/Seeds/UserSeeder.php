<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id'        => 1,
            'username'  => 'admin',
            'password'  => '$2y$10$MRn8zIEw18TKr5Wx3qhezep4lralPnysJvPOa7At5h9Fv9xbIv2GS',
        ];

        $this->db->table('users')->emptyTable();
        $this->db->table('users')->insert($data);
    }
}
