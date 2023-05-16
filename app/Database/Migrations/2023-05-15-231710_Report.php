<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Report extends Migration
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
                'type'           => 'VARCHAR',
                'constraint'     => '100',

            ],
            'voucher'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'price'  => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'date'  => [
                'type'           => 'date',
            ],
            'time'  => [
                'type'           => 'time',
            ],

            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('report');
    }

    public function down()
    {
        $this->forge->dropTable('report', TRUE);
    }
}
