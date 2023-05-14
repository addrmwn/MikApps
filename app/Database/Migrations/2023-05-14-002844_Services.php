<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
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
            'service'  => [
                'type'           => 'text',
            ],
            'shared'  => [
                'type'           => 'text',
            ],
            'ratelimit'  => [
                'type'           => 'text',
            ],
            'uptime'  => [
                'type'           => 'text',
            ],
            'price'  => [
                'type'           => 'text',
            ],

            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('services');
    }

    public function down()
    {
        $this->forge->dropTable('services', TRUE);
    }
}
