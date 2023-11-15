<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'tbl_guru';
    protected $primaryKey = 'id_guru';
    protected $allowedFields = [
        'id_user', 
        'nama', 
        'email',
        'nip', 
        'tempat_lahir',
        'tanggal_lahir',
        'jk', 
        'foto', 
    ];

    public function getGuruByUserId($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
}
