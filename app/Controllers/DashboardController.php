<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SiswaModel;
// use App\Models\OrtuModel;
use App\Models\KelasModel;
// use App\Models\JurusanModel;
use App\Models\GuruModel;
// use App\Models\WaliKelasModel;
// use App\Models\KeaktifanSiswaModel;
// use App\Models\PengumumanModel;
// use App\Models\EvaluasiGuruModel;
use App\Models\PelanggaranModel;
use App\Models\PrestasiAkademikModel;
// use App\Models\PrestasiNonAkademikModel;
// use App\Models\RankingModel;

class DashboardController extends BaseController
{
    protected $pelanggaranModel;
    protected $siswaModel;
    protected $kelasModel;
    protected $userModel;
    protected $guruModel;
    protected $prestasiModel;

    public function __construct()
    {
        $this->pelanggaranModel = new PelanggaranModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->prestasiModel = new PrestasiAkademikModel();
        $this->guruModel = new GuruModel();
        $this->userModel = new UserModel();

        if (!session()->has('auth')) {
            return redirect()->to(base_url('login'));
        }
    }

    public function index(): string
    {
        $userRole = session()->get('role');
        $siswa_id = session()->get('siswa_id');
        $orangtua_id = session()->get('ortu_id');
        $user_id = session()->get('id_user');

        switch ($userRole) {
            case 'Admin':

            $pelanggaran = $this->pelanggaranModel->findAll();
            $siswa = $this->siswaModel->findAll();
            $kelas = $this->kelasModel->findAll();
            $guru = $this->guruModel->findAll();
            $user = $this->userModel->findAll();
            $prestasi = $this->prestasiModel->findAll();

            $data = [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'user' => $user,
                'siswa' => $siswa,
                'kelas' => $kelas,
                'guru' => $guru,
                'pelanggaran' => $pelanggaran,
                'prestasi' => $prestasi,
            ];
            return view('admin/index', $data);
            break;

            // ROLE SISWA
            case 'Siswa':

            $modelUser = new UserModel();
            $user = $modelUser->find($user_id);

            $modelPelanggaran = new PelanggaranModel();
            $countPelanggaran = $modelPelanggaran->where('id_siswa', $siswa_id)->countAllResults();

            $modelAkademik = new PrestasiAkademikModel();
            $countAkademik = $modelAkademik->where('id_siswa', $siswa_id)->countAllResults();

            $data = [
                'title' => 'Dashboard Siswa',
                'active' => 'dashboard',
                'countPelanggaran' => $countPelanggaran,
                'countAkademik' => $countAkademik,
                'user' => $user,
            ];
            return view('siswa/index', $data);
            break;

            case 'Guru':
            $pelanggaran = $this->pelanggaranModel->findAll();
            $prestasi = $this->prestasiModel->findAll();
            $siswa = $this->siswaModel->findAll();

            $data = [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'siswa' => $siswa,
                'pelanggaran' => $pelanggaran,
                'prestasi' => $prestasi,
            ];
            return view('guru/index', $data);
            break;
        }
    }

    public function profile()
    {
        $model = $this->userModel;
        $guru = $this->guruModel;
        $email = session()->get('email');
        $user = session()->get('id_user');
        $userData = $model->where('email', $email)->first();
        $guruData = $guru->getGuruByUserId($user);

        $data = [
            'title' => 'Profile',
            'active' => 'profile',
            'userData' => $userData,
            'guruData' => $guruData,
        ];

        $session = \Config\Services::session();
        if ($session->get('role') == 'Admin') {
            return view('admin/profile', $data);
        } elseif ($session->get('role') == 'Guru') {
            return view('guru/profile', $data);
        } elseif ($session->get('role') == 'Siswa') {
            return view('siswa/profile', $data);
        }
    }

    public function updateProfile($id)
    {
        $guruModel = new GuruModel();
        $userModel = new UserModel();

        $guru = $guruModel->find($id);

        if (!$guru) {
            return redirect()->to(site_url('admin/data-guru'))->with('error', 'Data guru tidak ditemukan.');
        }

        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
            if (!empty($guru['foto'])) {
                unlink('uploads/guru/' . $guru['foto']);
            }

            $extension = $foto->getClientExtension();
            $namaPengguna = $this->request->getPost('nama');
            $newName = $namaPengguna . '_' . date('dmYHis') . '.' . $extension;
            $foto->move('uploads/guru', $newName);
            $data['foto'] = $newName;
        }

        $data['nama'] = $this->request->getPost('nama');
        $data['email'] = $this->request->getPost('email');
        $data['nip'] = $this->request->getPost('nip');
        $data['jk'] = $this->request->getPost('jk');
        $data['tempat_lahir'] = $this->request->getPost('tempat_lahir');
        $data['tanggal_lahir'] = $this->request->getPost('tanggal_lahir');
        $data['password'] = $this->request->getPost('password');

        $pengecekanData = $guruModel->where('nama', $data['nama'])->where('id_guru !=', $id)->first();
        if ($pengecekanData) {
            return redirect()->back()->with('error', 'Nama guru sudah ada dalam database.');
        }

        $guruModel->update($id, $data);
        
        $id_user = $guru['id_user'];
        if (!empty($data['email']) || !empty($data['password'])) {
            if ($id_user === null || $id_user == 0) {
                $email = $data['email'];
                $password = $data['password'];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $userData = [
                    'email' => $email,
                    'nama' => $data['nama'],
                    'password' => $passwordHash,
                    'role' => 'Guru',
                    'status' => 'Active',
                ];

                $id_user = $userModel->insert($userData);
                $id_user = $userModel->getInsertID();
                $guruModel->where('nama', $nama)->set(['id_user' => $id_user])->update();
            } else {
                $email = $data['email'];

                $userData = [
                    'email' => $email,
                    'nama' => $data['nama'],
                    'role' => 'Guru',
                    'status' => 'Active',
                ];

                $userModel->update($id_user, $userData);
            }
        }

        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }
}
