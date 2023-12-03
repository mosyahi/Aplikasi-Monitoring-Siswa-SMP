<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblPrestasiAkademik extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_prestasi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'created_by_user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'kategori_prestasi' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'nama_prestasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'keterangan_prestasi' => [
                'type' => 'TEXT',
            ],
            'tgl_prestasi' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_prestasi', true);
        // $this->forge->addForeignKey('id_siswa', 'tbl_siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_prestasi_akademik');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_prestasi_akademik');
    }
}
