<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiAkademikModel extends Model
{
    protected $table = 'tbl_prestasi_akademik';
    protected $primaryKey = 'id_prestasi';
    protected $allowedFields = [
        'id_siswa', 
        'created_by_user_id', 
        'kategori_prestasi', 
        'nama_prestasi', 
        'keterangan_prestasi', 
        'tgl_prestasi', 
        'foto', 
    ];
}
