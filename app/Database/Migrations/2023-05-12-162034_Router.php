<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Router extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'null'           => false,
            ],
            'nama'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'dns'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'ip'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'username'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'password'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'traffic_interface'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],

            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('router');
    }

    public function down()
    {
        $this->forge->dropTable('router', TRUE);
    }
}
