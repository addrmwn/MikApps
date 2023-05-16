<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Voucher extends Migration
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
            'oid'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'service'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'code'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'price'  => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'datetime'  => [
                'type'           => 'datetime',
            ],
            'comment'  => [
                'type'           => 'text',
                'null'           => true,
            ],
            'status'  => [
                'type'           => 'ENUM("0","1")',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('voucher');
    }

    public function down()
    {
        $this->forge->dropTable('voucher', TRUE);
    }
}
