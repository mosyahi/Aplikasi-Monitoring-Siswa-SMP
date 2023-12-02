<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrestasiAkademikModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\OrtuModel;

class PrestasiAkademikController extends BaseController
{
    protected $prestasiAkademikModel;
    protected $siswaModel;
    protected $ortuModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->prestasiAkademikModel = new PrestasiAkademikModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->ortuModel = new OrtuModel();
    }

    public function index()
    {
        $userRole = session()->get('role');
        $siswa_id = session()->get('siswa_id');
        $ortu_id = session()->get('ortu_id');

        switch ($userRole) {

                // ROLE ADMIN
            case 'Admin':
                $prestasi = $this->prestasiAkademikModel->findAll();
                $siswa = $this->siswaModel->findAll();
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
                    'title' => 'Prestasi Akademik',
                    'active' => 'prestasi',
                    'prestasi' => $prestasi,
                    'siswa' => $siswa,
                    'kelasSiswa' => $kelasSiswa,
                ];

                return view('admin/prestasi/prestasi-akademik', $data);
                break;

                //Role Guru
            case 'Guru':
                $prestasi = $this->prestasiAkademikModel->findAll();
                $siswa = $this->siswaModel->findAll();
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
                    'title' => 'Prestasi Akademik',
                    'active' => 'prestasi',
                    'prestasi' => $prestasi,
                    'siswa' => $siswa,
                    'kelasSiswa' => $kelasSiswa,
                ];

                return view('guru/prestasi/prestasi-akademik', $data);
                break;

                // ROLE SISWA
            case 'Siswa':
                $prestasi = $this->prestasiAkademikModel->where('id_siswa', $siswa_id)->findAll();
                $siswa = $this->siswaModel->find($siswa_id);
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
                    'title' => 'Prestasi Akademik',
                    'active' => 'prestasi',
                    'prestasi' => $prestasi,
                    'siswa' => $siswa,
                    'kelasSiswa' => $kelasSiswa,
                ];
                return view('siswa/prestasi/prestasi-akademik', $data);
                break;

                //ROLE ORANG TUA
            case 'Orangtua':
                $ortu_id = session()->get('ortu_id');
                $prestasi = $this->prestasiAkademikModel->where('id_siswa', $ortu_id)->findAll();
                $siswa = $this->siswaModel->find($ortu_id); // Use $ortu_id here
                $ortu = $this->ortuModel->find($ortu_id); // Corrected: Use $ortu_id to find the parent data
                $kelas = $this->kelasModel->findAll();

                $kelasSiswa = [];
                if (!empty($ortu) && array_key_exists('id_kelas', $ortu)) {
                    $targetId = $ortu['id_kelas'];

                    foreach ($kelas as $oi) {
                        if ($oi['id_kelas'] == $targetId) {
                            $namaKelas = $oi['tingkat'] . ' ' . $oi['tipe_kelas'];
                            $kelasSiswa[$ortu['id_siswa']] = $namaKelas;
                            break;
                        }
                    }
                }

                $data = [
                    'title' => 'Prestasi Akademik',
                    'active' => 'prestasi',
                    'prestasi' => $prestasi,
                    'siswa' => $siswa,
                    'ortu' => $ortu,
                    'kelasSiswa' => $kelasSiswa,
                ];

                return view('orang-tua/prestasi/prestasi-akademik', $data);
                break;
        }
    }


    public function add()
    {
        $model = new PrestasiAkademikModel();

        $validationRules = [
            'id_siswa' => 'required|trim',
            'kategori_prestasi' => 'required|trim',
            'nama_prestasi' => 'required|trim',
            'keterangan_prestasi' => 'required|trim',
            'tgl_prestasi' => 'required|trim',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png,image/jpg]',
        ];

        $validationMessages = [
            'id_siswa.required' => 'Siswa Harus Diisi.',
            'kategori_prestasi.required' => 'Kategori prestasi harus diisi.',
            'nama_prestasi.required' => 'Nama prestasi harus diisi.',
            'keterangan_prestasi.required' => 'Keterangan harus diisi.',
            'tgl_prestasi.required' => 'Tanggal harus diisi.',
            'foto.uploaded' => 'Foto harus diunggah.',
            'foto.mime_in' => 'Format foto harus JPEG atau PNG.',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_siswa = $this->request->getPost('id_siswa');
        $kategori_prestasi = $this->request->getPost('kategori_prestasi');
        $nama_prestasi = $this->request->getPost('nama_prestasi');
        $keterangan_prestasi = $this->request->getPost('keterangan_prestasi');
        $tgl_prestasi = $this->request->getPost('tgl_prestasi');

        $foto = $this->request->getFile('foto');

        if ($foto->isValid() && !$foto->hasMoved()) {

            $extension = $foto->getClientExtension();
            $namaPrestasi = $this->request->getPost('nama_prestasi');
            $newName = $namaPrestasi . '_' . date('dmYHis') . '.' . $extension;

            $foto->move('uploads/prestasi-akademik/', $newName);

            $data = [
                'nama_prestasi' => $nama_prestasi,
                'kategori_prestasi' => $kategori_prestasi,
                'id_siswa' => $id_siswa,
                'keterangan_prestasi' => $keterangan_prestasi,
                'tgl_prestasi' => $tgl_prestasi,
                'foto' => $newName,
            ];
            $model->insert($data);

            return redirect()->to('admin/prestasi-akademik')->with('success', 'Data berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah foto. Pastikan Anda mengunggah file gambar (JPEG atau PNG).');
        }
    }


    public function update($id)
    {
        $model = new PrestasiAkademikModel();
        $dataPrestasiAkademik = $model->find($id);
        // $ketegoriModel = new KategoriModel();

        $validationRules = [
            'id_siswa' => 'required|trim',
            'kategori_prestasi' => 'required|trim',
            'nama_prestasi' => 'required|trim',
            'keterangan_prestasi' => 'required|trim',
            'tgl_prestasi' => 'required|trim',
            // 'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png,image/jpg]',
        ];

        $validationMessages = [
            'id_siswa.required' => 'Siswa Harus Diisi.',
            'kategori_prestasi.required' => 'Kategori prestasi harus diisi.',
            'nama_prestasi.required' => 'Nama prestasi harus diisi.',
            'keterangan_prestasi.required' => 'Keterangan harus diisi.',
            'tgl_prestasi.required' => 'Tanggal harus diisi.',
            // 'foto.uploaded' => 'Foto harus diunggah.',
            // 'foto.mime_in' => 'Format foto harus JPEG atau PNG.',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_siswa = $this->request->getPost('id_siswa');
        $kategori_prestasi = $this->request->getPost('kategori_prestasi');
        $nama_prestasi = $this->request->getPost('nama_prestasi');
        $keterangan_prestasi = $this->request->getPost('keterangan_prestasi');
        $tgl_prestasi = $this->request->getPost('tgl_prestasi');

        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $extension = $foto->getClientExtension();
            $newName = $nama_prestasi . '_' . date('dmYHis') . '.' . $extension;
            $foto->move('uploads/prestasi-akademik/', $newName);

            if ($dataPrestasiAkademik['foto']) {
                unlink('uploads/prestasi-akademik/' . $dataPrestasiAkademik['foto']);
            }

            $data = [
                'nama_prestasi' => $nama_prestasi,
                'kategori_prestasi' => $kategori_prestasi,
                'id_siswa' => $id_siswa,
                'keterangan_prestasi' => $keterangan_prestasi,
                'tgl_prestasi' => $tgl_prestasi,
                'foto' => $newName,
            ];
        } else {
            $data = [
                'nama_prestasi' => $nama_prestasi,
                'kategori_prestasi' => $kategori_prestasi,
                'id_siswa' => $id_siswa,
                'keterangan_prestasi' => $keterangan_prestasi,
                'tgl_prestasi' => $tgl_prestasi,
            ];
        }

        $model->update($id, $data);

        return redirect()->to('admin/prestasi-akademik')->with('success', 'Data berhasil diperbaharui.');
    }


    public function delete($id)
    {
        $model = new PrestasiAkademikModel();
        $prestasi = $model->find($id);

        if (!$prestasi) {
            return redirect()->back()->with('error', 'Data prestasi tidak ditemukan.');
        }

        $fotoPath = 'uploads/prestasi-akademik/' . $prestasi['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }

        $model->delete($id);

        return redirect()->back()->with('success', 'Data prestasi berhasil dihapus.');
    }
}
