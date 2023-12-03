<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table = 'tbl_pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    protected $allowedFields = [
        'id_siswa', 
        'created_by_user_id', 
        'jenis_pelanggaran', 
        'jenis_sp', 
        'panggilan_ortu', 
        'keterangan_pelanggaran', 
        'surat_peringatan',
    ];
}
