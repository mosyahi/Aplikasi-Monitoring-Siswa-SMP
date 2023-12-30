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
use App\Models\PresensiModel;
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
    protected $presensiModel;

    public function __construct()
    {
        $this->pelanggaranModel = new PelanggaranModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->prestasiModel = new PrestasiAkademikModel();
        $this->guruModel = new GuruModel();
        $this->userModel = new UserModel();
        $this->presensiModel = new PresensiModel();

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
                $presensi = $this->presensiModel->findAll();

                $data = [
                    'title' => 'Dashboard',
                    'active' => 'dashboard',
                    'user' => $user,
                    'siswa' => $siswa,
                    'kelas' => $kelas,
                    'guru' => $guru,
                    'pelanggaran' => $pelanggaran,
                    'prestasi' => $prestasi,
                    'presensi' => $presensi,
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
                $presensi = $this->presensiModel->findAll();

                $data = [
                    'title' => 'Dashboard',
                    'active' => 'dashboard',
                    'siswa' => $siswa,
                    'pelanggaran' => $pelanggaran,
                    'prestasi' => $prestasi,
                    'presensi' => $presensi,

                ];
                return view('guru/index', $data);
                break;
        }
    }
}
