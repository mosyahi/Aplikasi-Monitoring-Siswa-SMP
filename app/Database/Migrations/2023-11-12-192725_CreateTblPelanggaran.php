<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblPelanggaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggaran' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'jenis_pelanggaran' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'jenis_sp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'panggilan_ortu' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'keterangan_pelanggaran' => [
                'type' => 'TEXT',
            ],
            'surat_peringatan' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_pelanggaran', true);
        $this->forge->createTable('tbl_pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_pelanggaran');
    }
}
