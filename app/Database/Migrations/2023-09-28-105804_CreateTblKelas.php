<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tingkat' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'tipe_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_kelas', true);
        // $this->forge->addForeignKey('id_jurusan', 'tbl_jurusan', 'id_jurusan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_kelas');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kelas');
    }
}
