<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\PresensiModel;


class AbsenController extends BaseController
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
        return view('guru/absen', $data);
    }

    public function add()
    {
        $tingkat = $this->request->getPost('tingkat');
        $tipe_kelas = $this->request->getPost('tipe_kelas');

        $modelKelas = new KelasModel();

        $validationRules = [
            'tingkat' => 'required',
            'tipe_kelas' => 'required',
        ];

        $validationMessages = [
            'tingkat.required' => 'Tingkat kelas harus diisi.',
            'tipe_kelas.required' => 'Tipe kelas harus diisi.',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'tingkat' => $tingkat,
            'tipe_kelas' => $tipe_kelas,
        ];

        $cekData = $modelKelas->where('tingkat', $userData['tingkat'])
            ->where('tipe_kelas', $userData['tipe_kelas'])
            ->countAllResults();

        if ($cekData > 0) {
            return redirect()->back()->withInput()->with('error', 'Kelas tersebut sudah ada dalam database.');
        }

        $modelKelas->insert($userData);
        session()->setFlashdata('success', 'Data kelas berhasil ditambahkan.');
        return redirect()->back();
    }


    public function update($id)
    {
        $tingkat = $this->request->getPost('tingkat');
        $tipe_kelas = $this->request->getPost('tipe_kelas');

        $modelKelas = new KelasModel();

        $userData = [
            'tingkat' => $tingkat,
            'tipe_kelas' => $tipe_kelas,
        ];

        $cekData = $modelKelas->where('tingkat', $userData['tingkat'])
            ->where('tipe_kelas', $userData['tipe_kelas'])
            ->countAllResults();

        if ($cekData > 0) {
            return redirect()->back()->withInput()->with('error', 'Gagal diperbaharui! Kelas tersebut sudah ada dalam database.');
        }

        $modelKelas->update($id, $userData);
        session()->setFlashdata('success', 'Data kelas berhasil diperbaharui.');
        return redirect()->back();
    }


    public function delete($id)
    {
        $modelKelas = new KelasModel();
        $kelas = $modelKelas->find($id);
        if ($kelas) {
            $modelKelas->delete($id);

            session()->setFlashdata('success', 'Data kelas berhasil dihapus.');
        }
        return redirect()->back();
    }

    public function anggota()
    {
        $model = new SiswaModel;
        $siswa = $model->findAll();

        $modelKelas = new KelasModel;
        $kelas = $modelKelas->findAll();

        $kelasSiswa = [];
        if (!empty($siswa)) {
            foreach ($siswa as $item) {
                $namaKelas = '';
                foreach ($kelas as $oi) {
                    if ($oi['id_kelas'] == $item['id_kelas']) {
                        $namaKelas = $oi['tingkat'] . ' ' . $oi['tipe_kelas'];
                        $kelasSiswa[$item['id_siswa']] = $namaKelas;
                        break;
                    }
                }
            }
        }

        $data = [
            'title' => 'Anggota Kelas',
            'active' => 'anggota',
            'siswa' => $siswa,
            'kelas' => $kelas,
            'kelasSiswa' => $kelasSiswa,
        ];

        $session = \Config\Services::session();
        if ($session->get('role') == 'Guru') {
            return view('guru/data-kelas/anggota', $data);
        } elseif ($session->get('role') == 'Guru') {
            return view('guru/data-kelas/anggota', $data);
        }
    }



    public function markPresensi($idSiswa, $status)
    {
        try {
            // Validasi status presensi
            if (!in_array($status, ['hadir', 'alpa'])) {
                throw new \Exception('Status presensi tidak valid.');
            }

            // Ambil id_guru dari sesi atau informasi pengguna yang masuk
            $idGuru = 1; // Gantilah ini dengan cara sesuai mendapatkan id_guru

            $tanggal = date('Y-m-d');
            // Simpan data presensi ke database
            $modelPresensi = new PresensiModel();
            $dataPresensi = [
                'id_guru' => $idGuru,
                'id_siswa' => $idSiswa,
                'status' => $status,
                'tanggal' => $tanggal
            ];

            $success = $modelPresensi->insert($dataPresensi);

            if (!$success) {
                throw new \Exception('Gagal menyimpan data presensi.');
            }

            // Respon JSON jika sukses
            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            // Tangkap dan kirim pesan kesalahan jika terjadi
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function viewPresensi($idSiswa)
    {
        $modelPresensi = new PresensiModel();
        $presensi = $modelPresensi->getPresensiBySiswa($idSiswa);

        $data = [
            'title' => 'Presensi Siswa',
            'active' => 'absen',
            'presensi' => $presensi,
        ];

        return view('guru/view_presensi', $data);
    }
}
