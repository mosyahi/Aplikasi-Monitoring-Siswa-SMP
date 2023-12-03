<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelanggaranModel;
use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\KelasModel;

class PelanggaranController extends BaseController
{
    protected $pelanggaranModel;
    protected $userModel;
    protected $siswaModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->pelanggaranModel = new PelanggaranModel();
        $this->userModel = new UserModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        $userRole = session()->get('role');
        $siswa_id = session()->get('siswa_id');
        $user_id = session()->get('id_user');

        switch ($userRole) {

            // ROLE ADMIN
            case 'Admin':
            $pelanggaran = $this->pelanggaranModel->findAll();
            $siswa = $this->siswaModel->findAll();
            $user = $this->userModel->findAll();
            $kelas = $this->kelasModel->findAll();

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
                'title' => 'Data Pelanggaran',
                'active' => 'pelanggaran',
                'siswa' => $siswa,
                'kelas' => $kelas,
                'user' => $user,
                'pelanggaran' => $pelanggaran,
                'kelasSiswa' => $kelasSiswa,
            ];
            return view('admin/pelanggaran', $data);
            break;

            //Guru
            case 'Guru':
            $pelanggaran = $this->pelanggaranModel->where('created_by_user_id', $user_id)->findAll();
            $siswa = $this->siswaModel->findAll();
            $user = $this->userModel->findAll();
            $kelas = $this->kelasModel->findAll();

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
                'title' => 'Data Pelanggaran',
                'active' => 'pelanggaran',
                'siswa' => $siswa,
                'kelas' => $kelas,
                'user' => $user,
                'pelanggaran' => $pelanggaran,
                'kelasSiswa' => $kelasSiswa,
            ];
            return view('guru/pelanggaran', $data);
            break;

            // ROLE SISWA
            case 'Siswa':
            $pelanggaran = $this->pelanggaranModel->where('id_siswa', $siswa_id)->findAll();
            $siswa = $this->siswaModel->find($siswa_id);
            // $ortu = $this->ortuModel->findAll();
            $kelas = $this->kelasModel->findAll();

            $kelasSiswa = [];
            if (!empty($siswa)) {
                $namaKelas = '';
                foreach ($kelas as $oi) {
                    if ($oi['id_kelas'] == $siswa['id_kelas']) {
                        $namaKelas = $oi['tingkat'] . ' ' . $oi['tipe_kelas'];
                        $kelasSiswa[$siswa['id_siswa']] = $namaKelas;
                        break;
                    }
                }
            }

            $data = [
                'title' => 'Data Pelanggaran',
                'active' => 'pelanggaran',
                'siswa' => $siswa,
                'kelas' => $kelas,
                // 'ortu' => $ortu,
                'pelanggaran' => $pelanggaran,
                'kelasSiswa' => $kelasSiswa,
            ];
            return view('siswa/pelanggaran', $data);
            break;
        }
    }


    public function add()
    {
        $model = new PelanggaranModel();

        $id_siswa = $this->request->getPost('id_siswa');
        $jenis_pelanggaran = $this->request->getPost('jenis_pelanggaran');
        $jenis_sp = $this->request->getPost('jenis_sp');
        $panggilan_ortu = $this->request->getPost('panggilan_ortu');
        $keterangan_pelanggaran = $this->request->getPost('keterangan_pelanggaran');
        $created_by_user_id = $this->request->getPost('created_by_user_id');

        $siswaModel = new SiswaModel();
        $namaSiswaID = $siswaModel->find($id_siswa);

        $file = $this->request->getFile('surat_peringatan');
        $newName = null;

        if ($file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();
            $newName = $jenis_sp . '_' . $namaSiswaID['nama'] . '_' . date('dmYHis') . '.' . $extension;
            $file->move('uploads/sp/', $newName);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_siswa' => 'required',
            'jenis_pelanggaran' => 'required',
            'jenis_sp' => 'required',
            'panggilan_ortu' => 'required',
            'keterangan_pelanggaran' => 'required|trim',
            // 'surat_peringatan' => 'uploaded[surat_peringatan]|ext_in[surat_peringatan,pdf]|max_size[surat_peringatan,1024]',
        ]);

        $inputData = [
            'id_siswa' => $id_siswa,
            'jenis_pelanggaran' => $jenis_pelanggaran,
            'jenis_sp' => $jenis_sp,
            'panggilan_ortu' => $panggilan_ortu,
            'keterangan_pelanggaran' => $keterangan_pelanggaran,
            // 'surat_peringatan' => $file->isValid() && !$file->hasMoved() ? $namaSiswaID['nama'] . '_surat_peringatan.pdf' : null,
        ];


        if (!$validation->run($inputData)) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput($inputData)->with('error', 'Gagal disimpan! ' . implode(' ', $errors));
        }

        $userData = [
            'id_siswa' => $id_siswa,
            'created_by_user_id' => $created_by_user_id,
            'jenis_pelanggaran' => $jenis_pelanggaran,
            'jenis_sp' => $jenis_sp,
            'panggilan_ortu' => $panggilan_ortu,
            'keterangan_pelanggaran' => $keterangan_pelanggaran,
            'surat_peringatan' => $newName,
        ];

        $model->insert($userData);
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->back();
    }


    public function update($id, $nama)
    {
        $model = new PelanggaranModel();
        $dataPelanggaran = $model->find($id);

        $validation = [
            'id_siswa' => 'required',
            'jenis_pelanggaran' => 'required',
            'jenis_sp' => 'required',
            'panggilan_ortu' => 'required',
            'keterangan_pelanggaran' => 'required|trim',
        ];

        if (!$this->validate($validation)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_siswa = $this->request->getPost('id_siswa');
        $jenis_pelanggaran = $this->request->getPost('jenis_pelanggaran');
        $jenis_sp = $this->request->getPost('jenis_sp');
        $panggilan_ortu = $this->request->getPost('panggilan_ortu');
        $keterangan_pelanggaran = $this->request->getPost('keterangan_pelanggaran');
        $created_by_user_id = $this->request->getPost('created_by_user_id');

        $siswaModel = new SiswaModel();
        $namaSiswaID = $siswaModel->find($id_siswa);

        $file = $this->request->getFile('surat_peringatan');
        $newName = null;

        if ($file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();
            $newName = $jenis_sp . '_' . $namaSiswaID['nama'] . '_' . date('dmYHis') . '.' . $extension;
            $file->move('uploads/sp/', $newName);

            if ($dataPelanggaran['surat_peringatan']) {
                unlink('uploads/sp/' . $dataPelanggaran['surat_peringatan']);
            }

            $data = [
                'id_siswa' => $id_siswa,
                'created_by_user_id' => $created_by_user_id,
                'jenis_pelanggaran' => $jenis_pelanggaran,
                'jenis_sp' => $jenis_sp,
                'panggilan_ortu' => $panggilan_ortu,
                'keterangan_pelanggaran' => $keterangan_pelanggaran,
                'surat_peringatan' => $newName,
            ];
        } else {
            $data = [
                'id_siswa' => $id_siswa,
                'created_by_user_id' => $created_by_user_id,
                'jenis_pelanggaran' => $jenis_pelanggaran,
                'jenis_sp' => $jenis_sp,
                'panggilan_ortu' => $panggilan_ortu,
                'keterangan_pelanggaran' => $keterangan_pelanggaran,
            ];
        }

        $model->update($id, $data);

        return redirect()->back()->with('success', 'Data berhasil diperbaharui.');
    }


    public function delete($id)
    {
        $model = new PelanggaranModel();
        $pelanggaran = $model->find($id);

        if (!$pelanggaran) {
            return redirect()->back()->with('error', 'Data pelanggaran tidak ditemukan.');
        }

        $file = 'uploads/sp/' . $pelanggaran['surat_peringatan'];

        // Pengecekan apakah file ada dan nilai tidak null
        if ($pelanggaran['surat_peringatan'] && file_exists($file)) {
            unlink($file);
        }

        $model->delete($id);
        return redirect()->back()->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}
