<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'tbl_siswa';
    protected $primaryKey = 'id_siswa';
    protected $allowedFields = [
        'id_user', 
        'id_kelas', 
        'nama', 
        'jk',
        'alamat',
        'foto', 
        'no_hp', 
        'no_hp_orangtua', 
        'nis', 
        'tgl_lahir',
        'email',
    ];

    public function getSiswaByUserId($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
}
