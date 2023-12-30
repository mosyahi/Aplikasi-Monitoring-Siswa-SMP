<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\PresensiModel;

class PresensiAdminController extends BaseController
{
    public function index()
    {
        $model = new SiswaModel;
        $siswa = $model->findAll();

        $model = new KelasModel();
        $kelas = $model->findAll();

        $model = new PresensiModel();
        $presensi = $model->findAll();

        $data = [
            'title' => 'Absensi',
            'active' => 'absen',
            'kelas' => $kelas,
            'siswa' => $siswa,
            'presensi' => $presensi

        ];

        return view('admin/absen', $data);
    }
}
