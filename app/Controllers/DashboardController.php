<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\OrtuModel;
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
use App\Models\RankingModel;

class DashboardController extends BaseController
{
    public function __construct()
    {
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

            case 'Admin':

                $model = new UserModel();
                $modelSiswa = new SiswaModel();
                $modelOrtu = new OrtuModel();
                $modelKelas = new KelasModel();
                $modelGuru = new GuruModel();

                $orangtua = $modelOrtu->findAll();
                $admin = $model->findAll();
                $siswa = $modelSiswa->findAll();
                $kelas = $modelKelas->findAll();
                $guru = $modelGuru->findAll();

                $data = [
                    'title' => 'Dashboard',
                    'active' => 'dashboard',
                    'user' => $admin,
                    'siswa' => $siswa,
                    'orangtua' => $orangtua,
                    'kelas' => $kelas,
                    'guru' => $guru,
                ];
                return view('admin/index', $data);
                break;

            case 'Guru':

                $model = new UserModel();
                $modelSiswa = new SiswaModel();
                $modelOrtu = new OrtuModel();
                $modelKelas = new KelasModel();
                $modelGuru = new GuruModel();

                $orangtua = $modelOrtu->findAll();
                $admin = $model->findAll();
                $siswa = $modelSiswa->findAll();
                $kelas = $modelKelas->findAll();
                $guru = $modelGuru->findAll();

                $data = [
                    'title' => 'Dashboard',
                    'active' => 'dashboard',
                    'user' => $admin,
                    'siswa' => $siswa,
                    'orangtua' => $orangtua,
                    'kelas' => $kelas,
                    'guru' => $guru,
                ];
                return view('guru/index', $data);
                break;

            case 'Orangtua':

                $modelUser = new UserModel();
                $user = $modelUser->find($user_id);

                $modelPelanggaran = new PelanggaranModel();
                $countPelanggaran = $modelPelanggaran->where('id_siswa', $orangtua_id)->countAllResults();

                $modelAkademik = new PrestasiAkademikModel();
                $countAkademik = $modelAkademik->where('id_siswa', $orangtua_id)->countAllResults();

                $data = [
                    'title' => 'Dashboard Orang Tua',
                    'active' => 'dashboard',
                    'countPelanggaran' => $countPelanggaran,
                    'countAkademik' => $countAkademik,
                    'user' => $user,
                ];
                return view('orang-tua/index', $data);
                break;
        }
    }

    public function profile()
    {
        $adminModel = new UserModel();
        $email = session()->get('email');
        $userData = $adminModel->where('email', $email)->first();

        $data = [
            'title' => 'Profile',
            'active' => 'profile',
            'userData' => $userData,
        ];

        return view('admin/profile', $data);
    }

    public function faq()
    {
        $data = [
            'title' => 'Faq',
            'active' => 'faq',
        ];

        return view('admin/faq/index', $data);
    }
}
