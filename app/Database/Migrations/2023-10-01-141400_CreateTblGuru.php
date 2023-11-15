<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblGuru extends Migration
{
 public function up()
 {
    $this->forge->addField([
        'id_guru' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'id_user' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
        ],
        'nama' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
        ],
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => 150,
        ],
        'nip' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
        ],
        'jk' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
        ],
        'tempat_lahir' => [
            'type' => 'VARCHAR',
            'constraint' => 30,
        ],
        'tanggal_lahir' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
        ],
        'nama' => [
            'type' => 'TEXT',
        ],
        'foto' => [
            'type' => 'VARCHAR',
            'constraint' => 250,
        ],
        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
    ]);

    $this->forge->addKey('id_guru', true);
    // $this->forge->addForeignKey('id_user', 'tbl_user', 'id_user', 'CASCADE', 'CASCADE');
    $this->forge->createTable('tbl_guru');
}

public function down()
{
    $this->forge->dropTable('tbl_guru');
}
}
