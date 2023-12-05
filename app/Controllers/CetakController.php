<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Models\PelanggaranModel;
use App\Models\PrestasiAkademikModel;
use Dompdf\Dompdf;

class CetakController extends BaseController
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
    }

    public function laporanPrestasi($id)
    {
        $model = new PrestasiAkademikModel();

        $prestasiUtama = $model->find($id);

        if ($prestasiUtama) {
            $idSiswa = $prestasiUtama['id_siswa'];

            $laporanPrestasi = $model->select('tbl_prestasi_akademik.*, tbl_user.nama as nama_pembuat, tbl_siswa.nama, tbl_siswa.id_kelas, tbl_siswa.email, tbl_siswa.no_hp, tbl_siswa.no_hp_orangtua, tbl_siswa.alamat, tbl_siswa.nis, tbl_kelas.tingkat, tbl_kelas.tipe_kelas')
            ->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_prestasi_akademik.id_siswa', 'left')
            ->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_siswa.id_kelas', 'inner')
            ->join('tbl_user', 'tbl_user.id_user = tbl_prestasi_akademik.created_by_user_id', 'left')
            ->where('tbl_prestasi_akademik.id_siswa', $idSiswa)
            ->findAll();

            if ($laporanPrestasi) {
                $nomorSurat = $this->isiNomorSurat();

                $view = view('cetak/laporan-prestasi', ['laporanPrestasi' => $laporanPrestasi, 'nomorSurat' => $nomorSurat]);

                $dompdf = new Dompdf();
                $options = new \Dompdf\Options();
                $options->set('isPhpEnabled', true); 
                $options->set('isHtml5ParserEnabled', true); 
                $options->set('isRemoteEnabled', true); 
                $dompdf->setOptions($options);
                setlocale(LC_TIME, 'id_ID');

                $dompdf->loadHtml($view);

                $dompdf->setPaper('F4', 'landscape');

                $dompdf->render();

                $pdfContent = $dompdf->output();

                $filename = 'Laporan-Prestasi_' . date('d-m-Y_H-i-s') . '.pdf';

                $response = service('response');

                $response->setContentType('application/pdf');
                $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

                $response->setBody($pdfContent);

                return $response;
            } else {
                return "Tidak ada prestasi akademik yang ditemukan untuk siswa ini.";
            }
        } else {
            return "Prestasi akademik tidak ditemukan.";
        }
    }

    public function laporanPelanggaran($id)
    {
        $model = new PelanggaranModel();

        $pelanggaranUtama = $model->find($id);

        if ($pelanggaranUtama) {
            $idSiswa = $pelanggaranUtama['id_siswa'];

            $laporanPelanggaran = $model->select('tbl_pelanggaran.*, tbl_user.nama as nama_pembuat, tbl_siswa.nama, tbl_siswa.id_kelas, tbl_siswa.email, tbl_siswa.no_hp, tbl_siswa.no_hp_orangtua, tbl_siswa.alamat, tbl_siswa.nis, tbl_kelas.tingkat, tbl_kelas.tipe_kelas')
            ->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pelanggaran.id_siswa', 'left')
            ->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_siswa.id_kelas', 'inner')
            ->join('tbl_user', 'tbl_user.id_user = tbl_pelanggaran.created_by_user_id', 'left')
            ->where('tbl_pelanggaran.id_siswa', $idSiswa)
            ->findAll();

            if ($laporanPelanggaran) {
                $nomorSurat = $this->isiNomorSuratPelanggaran();

                $view = view('cetak/laporan-pelanggaran', ['laporanPelanggaran' => $laporanPelanggaran, 'nomorSurat' => $nomorSurat]);

                $dompdf = new Dompdf();
                $options = new \Dompdf\Options();
                $options->set('isPhpEnabled', true); 
                $options->set('isHtml5ParserEnabled', true); 
                $options->set('isRemoteEnabled', true); 
                $dompdf->setOptions($options);
                setlocale(LC_TIME, 'id_ID');

                $dompdf->loadHtml($view);

                $dompdf->setPaper('F4', 'landscape');

                $dompdf->render();

                $pdfContent = $dompdf->output();

                $filename = 'Laporan-Pelanggaran_' . date('d-m-Y_H-i-s') . '.pdf';

                $response = service('response');

                $response->setContentType('application/pdf');
                $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

                $response->setBody($pdfContent);

                return $response;
            } else {
                return "Tidak ada Pelanggaran yang ditemukan untuk siswa ini.";
            }
        } else {
            return "Pelanggaran tidak ditemukan.";
        }
    }

    public function laporanRekapMonitoring($id)
    {
        $pelanggaranModel = new PelanggaranModel();
        $prestasiModel = new PrestasiAkademikModel();
        $siswaModel = new SiswaModel();

        $siswa = $siswaModel->find($id);

        if ($siswa) {
            $idSiswa = $siswa['id_siswa'];

            $laporanPelanggaran = $pelanggaranModel->select('tbl_pelanggaran.*, tbl_user.nama as nama_pembuat, tbl_siswa.nama, tbl_siswa.id_kelas, tbl_siswa.email, tbl_siswa.no_hp, tbl_siswa.no_hp_orangtua, tbl_siswa.alamat, tbl_siswa.nis, tbl_kelas.tingkat, tbl_kelas.tipe_kelas')
            ->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pelanggaran.id_siswa', 'left')
            ->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_siswa.id_kelas', 'inner')
            ->join('tbl_user', 'tbl_user.id_user = tbl_pelanggaran.created_by_user_id', 'left')
            ->where('tbl_pelanggaran.id_siswa', $idSiswa)
            ->findAll();

            $laporanPrestasi = $prestasiModel->select('tbl_prestasi_akademik.*, tbl_user.nama as nama_pembuat, tbl_siswa.nama, tbl_siswa.id_kelas, tbl_siswa.email, tbl_siswa.no_hp, tbl_siswa.no_hp_orangtua, tbl_siswa.alamat, tbl_siswa.nis, tbl_kelas.tingkat, tbl_kelas.tipe_kelas')
            ->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_prestasi_akademik.id_siswa', 'left')
            ->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_siswa.id_kelas', 'inner')
            ->join('tbl_user', 'tbl_user.id_user = tbl_prestasi_akademik.created_by_user_id', 'left')
            ->where('tbl_prestasi_akademik.id_siswa', $idSiswa)
            ->findAll();

            if ($laporanPelanggaran || $laporanPrestasi) {
                $nomorSurat = $this->isiNomorSuratRekap();

                $view = view('cetak/laporan-rekap-monitoring', ['laporanPelanggaran' => $laporanPelanggaran, 'laporanPrestasi' => $laporanPrestasi, 'nomorSurat' => $nomorSurat]);

                $dompdf = new Dompdf();
                $options = new \Dompdf\Options();
                $options->set('isPhpEnabled', true); 
                $options->set('isHtml5ParserEnabled', true); 
                $options->set('isRemoteEnabled', true); 
                $dompdf->setOptions($options);
                setlocale(LC_TIME, 'id_ID');

                $dompdf->loadHtml($view);

                $dompdf->setPaper('F4', 'landscape');

                $dompdf->render();

                $pdfContent = $dompdf->output();

                $filename = 'Laporan-Pelanggaran_' . date('d-m-Y_H-i-s') . '.pdf';

                $response = service('response');

                $response->setContentType('application/pdf');
                $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

                $response->setBody($pdfContent);

                return $response;
            } else {
                return "Tidak ada Pelanggaran yang ditemukan untuk siswa ini.";
            }
        } else {
            return "Pelanggaran tidak ditemukan.";
        }
    }


    private function isiNomorSurat() {
        $session = session();

        if (!$session->has('nomor_urut')) {
            $session->set('nomor_urut', 1);
        }

        $nomorUrut = $session->get('nomor_urut');
        $bulanRomawi = $this->getBulanRomawi();
        $tahun = date('Y');

        $nomorSurat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT) . "/SMPN12/SM-CRB/PRST/" . $bulanRomawi . "/" . $tahun;

        $session->set('nomor_urut', $nomorUrut + 1);

        return $nomorSurat;
    }

    private function isiNomorSuratPelanggaran() {
        $session = session();

        if (!$session->has('nomor_urut')) {
            $session->set('nomor_urut', 1);
        }

        $nomorUrut = $session->get('nomor_urut');
        $bulanRomawi = $this->getBulanRomawi();
        $tahun = date('Y');

        $nomorSurat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT) . "/SMPN12/SM-CRB/PLGGRN/" . $bulanRomawi . "/" . $tahun;

        $session->set('nomor_urut', $nomorUrut + 1);

        return $nomorSurat;
    }

    private function isiNomorSuratRekap() {
        $session = session();

        if (!$session->has('nomor_urut')) {
            $session->set('nomor_urut', 1);
        }

        $nomorUrut = $session->get('nomor_urut');
        $bulanRomawi = $this->getBulanRomawi();
        $tahun = date('Y');

        $nomorSurat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT) . "/SMPN12/SM-CRB/RKP/" . $bulanRomawi . "/" . $tahun;

        $session->set('nomor_urut', $nomorUrut + 1);

        return $nomorSurat;
    }

    private function getBulanRomawi() {
        $bulanIndex = intval(date('m')) - 1;
        $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $romawi[$bulanIndex];
    }
}
