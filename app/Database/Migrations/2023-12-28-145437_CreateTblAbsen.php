<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbsen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_presensi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_guru' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id_presensi', true);
        $this->forge->createTable('tbl_presensi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_presensi');
    }
}
