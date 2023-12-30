<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table      = 'tbl_presensi';
    protected $primaryKey = 'id_presensi';

    protected $allowedFields = ['id_guru', 'id_siswa', 'status', 'tanggal'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    // ... (lainnya sesuai kebutuhan)

    public function getPresensiBySiswa($idSiswa)
    {
        return $this->where('id_siswa', $idSiswa)->findAll();
    }
}
