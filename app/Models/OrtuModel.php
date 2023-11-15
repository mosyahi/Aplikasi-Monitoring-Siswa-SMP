<?php

namespace App\Models;

use CodeIgniter\Model;

class OrtuModel extends Model
{
    protected $table = 'tbl_ortu';
    protected $primaryKey = 'id_ortu';
    protected $allowedFields = [
        'id_user', 
        'id_siswa', 
        'email', 
        'nama',
        'foto',
        'pekerjaan',
        'sbg',
        'alamat'
    ];

    public function getOrtuByUserId($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
}
