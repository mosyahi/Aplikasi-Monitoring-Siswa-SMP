<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\JurusanModel;
use App\Models\TapelModel;
use App\Models\KeaktifanSiswaModel;
use App\Models\OrtuModel;
use App\Models\RankingModel;
use App\Models\EkstrakurikulerModel;
use App\Models\AnggotaEkstrakurikulerModel;
use App\Models\PrestasiAkademikModel;
use App\Models\PrestasiNonAkademikModel;
use App\Models\PelanggaranModel;

class RekapMonitoringController extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    protected $ortuModel;
    protected $prestasiAkademikModel;
    protected $pelanggaranModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->ortuModel = new OrtuModel();
        $this->prestasiAkademikModel = new PrestasiAkademikModel();
        $this->pelanggaranModel = new PelanggaranModel();
    }

    public function index()
    {
        $userRole = session()->get('role');
        $siswa_id = session()->get('siswa_id');

        switch ($userRole) {

                // ROLE ADMIN
            case 'Admin':
                $siswa = $this->siswaModel->findAll();
                $kelas = $this->kelasModel->findAll();
                $ortu = $this->ortuModel->findAll();
                $prestasiAkademik = $this->prestasiAkademikModel->findAll();
                $pelanggaran = $this->pelanggaranModel->findAll();

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

                foreach ($siswa as $item) {
                    $ortuID = $this->ortuModel->where('id_siswa', $item['id_siswa'])->findAll();
                    $prestasiAkademikID = $this->prestasiAkademikModel->where('id_siswa', $item['id_siswa'])->findAll();
                    $pelanggaranID = $this->pelanggaranModel->where('id_siswa', $item['id_siswa'])->findAll();

                    $ortuData[$item['id_siswa']] = isset($ortuID) ? $ortuID : [];
                    $prestasiAkademikData[$item['id_siswa']] = isset($prestasiAkademikID) ? $prestasiAkademikID : [];
                    $pelanggaranData[$item['id_siswa']] = isset($pelanggaranID) ? $pelanggaranID : [];
                }

                $data = [
                    'title' => 'Rekap Monitoring',
                    'active' => 'rekap',
                    'kelas' => $kelas,
                    'siswa' => $siswa,
                    'kelasSiswa' => $kelasSiswa,
                    'ortuData' => isset($ortuData) ? $ortuData : [],
                    'prestasiAkademik' => isset($prestasiAkademikData) ? $prestasiAkademikData : [],
                    'pelanggaranData' => isset($pelanggaranData) ? $pelanggaranData : [],
                ];


                return view('admin/rekap-monitoring', $data);
                break;

            case 'Siswa':
                $siswa = $this->siswaModel->find($siswa_id);
                $kelas = $this->kelasModel->findAll();
                $ortu = $this->ortuModel->findAll();
                $prestasiAkademik = $this->prestasiAkademikModel->where('id_siswa', $siswa_id)->findAll();
                $pelanggaran = $this->pelanggaranModel->where('id_siswa', $siswa_id)->findAll();

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

                foreach ($siswa as $item) {
                    $ortuID = $this->ortuModel->where('id_siswa', $siswa_id)->findAll();
                    $prestasiAkademikID = $this->prestasiAkademikModel->where('id_siswa', $siswa_id)->findAll();
                    $pelanggaranID = $this->pelanggaranModel->where('id_siswa', $siswa_id)->findAll();

                    $ortuData = $ortuID;
                    $prestasiAkademikData = $prestasiAkademikID;
                    $pelanggaranData = $pelanggaranID;
                }

                $data = [
                    'title' => 'Rekap Monitoring',
                    'active' => 'rekap',
                    'kelas' => $kelas,
                    'siswa' => $siswa,
                    'kelasSiswa' => $kelasSiswa,
                    'ortuData' => $ortuData,
                    'prestasiAkademik' => $prestasiAkademikData,
                    'pelanggaranData' => $pelanggaranData,
                ];
                return view('siswa/rekap-monitoring', $data);
                break;

                //ROLE ORANG TUA
            case 'Orangtua':
                $ortu_id = session()->get('ortu_id');
                $siswa = $this->siswaModel->find($ortu_id);
                $kelas = $this->kelasModel->findAll();
                $ortuData = $this->ortuModel->where('id_siswa', $ortu_id)->findAll();
                $prestasiAkademikData = $this->prestasiAkademikModel->where('id_siswa', $ortu_id)->findAll();
                $pelanggaranData = $this->pelanggaranModel->where('id_siswa', $ortu_id)->findAll();

                $kelasSiswa = [];
                if (!empty($siswa) && array_key_exists('id_kelas', $siswa)) {
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
                    'title' => 'Rekap Monitoring',
                    'active' => 'rekap',
                    'kelas' => $kelas,
                    'siswa' => $siswa,
                    'kelasSiswa' => $kelasSiswa,
                    'ortuData' => $ortuData,
                    'prestasiAkademik' => $prestasiAkademikData,
                    'pelanggaranData' => $pelanggaranData,
                ];
                return view('orang-tua/rekap-monitoring', $data);
                break;
        }
    }
}
