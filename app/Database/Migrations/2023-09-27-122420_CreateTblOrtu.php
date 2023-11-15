<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblOrtu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ortu' => [
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
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'sbg' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addPrimaryKey('id_ortu');
        // $this->forge->addForeignKey('id_siswa', 'tbl_siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_user', 'tbl_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_ortu');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_ortu');
    }
}