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
        $modelSiswa = new SiswaModel();
        $siswa = $modelSiswa->findAll();

        $modelKelas = new KelasModel();
        $kelas = $modelKelas->findAll();

        $modelPresensi = new PresensiModel();
        $presensi = $modelPresensi->findAll();

        $data = [
            'title' => 'Absensi',
            'active' => 'absen',
            'kelas' => $kelas,
            'siswa' => $siswa,
            'presensi' => $presensi
        ];

        return view('admin/presensi/presensi', $data);
    }

    public function detail($id)
    {
        $modelSiswa = new SiswaModel();
        $siswa = $modelSiswa->where('id_kelas', $id)->findAll();

        $modelKelas = new KelasModel();
        $kelas = $modelKelas->findAll();

        $modelPresensi = new PresensiModel();
        $presensi = $modelPresensi->findAll();

        $data = [
            'title' => 'Absensi',
            'active' => 'absen',
            'kelas' => $kelas,
            'siswa' => $siswa,
            'presensi' => $presensi
        ];

        return view('admin/presensi/detail', $data);
    }
}
