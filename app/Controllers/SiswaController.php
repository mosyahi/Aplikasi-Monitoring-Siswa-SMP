<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\UserModel;
use App\Models\PresensiModel;

class SiswaController extends BaseController
{
    public function index()
    {
        $model = new SiswaModel;
        $siswa = $model->findAll();

        $modelKelas = new KelasModel;
        $kelas = $modelKelas->findAll();

        $model = new PresensiModel;
        $presensi = $model->findAll();

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
            'title' => 'Data Siswa',
            'active' => 'siswa',
            'siswa' => $siswa,
            'kelas' => $kelas,
            'kelasSiswa' => $kelasSiswa,
            'presensi' => $presensi
        ];

        return view('admin/data-siswa/index', $data);
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
        if ($session->get('role') == 'Admin') {
            return view('admin/data-kelas/anggota', $data);
        } elseif ($session->get('role') == 'Guru') {
            return view('guru/data-kelas/anggota', $data);
        }
    }

    public function new()
    {
        $model = new KelasModel;
        $kelas = $model->findAll();

        $data = [
            'title'     => 'Tambah Data Siswa',
            'active'    => 'siswa',
            'kelas'     => $kelas,
        ];
        return view('admin/data-siswa/new', $data);
    }

    private function ubahNomorTelepon($nomor)
    {
        if (substr($nomor, 0, 2) === '08') {
            $nomor = '628' . substr($nomor, 2);
        } elseif (substr($nomor, 0, 3) === '+62') {
            $nomor = '62' . substr($nomor, 3);
        }

        return $nomor;
    }

    public function add()
    {
        $model = new SiswaModel();
        $userModel = new UserModel();

        $validationRules = [
            'nama' => 'required|max_length[155]',
            'id_kelas' => 'required',
            'jk' => 'required',
            'alamat' => 'required|max_length[255]',
            'email' => 'required|valid_email',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png]',
            'nis' => 'required|max_length[10]|min_length[10]',
            'tgl_lahir' => 'required',
            'no_hp' => 'required|max_length[13]|min_length[10]',
            'no_hp_orangtua' => 'required|max_length[13]|min_length[10]',
        ];

        $validationMessages = [
            'nama.required' => 'Nama harus diisi.',
            'jk.required' => 'Jenis kelamin harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'id_kelas.required' => 'Kelas harus dipilih.',
            'email.required' => 'Email harus diisi.',
            'email.valid_email' => 'Email tidak valid.',
            'foto.uploaded' => 'Foto harus diunggah.',
            'foto.mime_in' => 'Format foto harus JPEG atau PNG.',
            'nis.required' => 'Pekerjaan harus diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi.',
            'nis.required' => 'Nis harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp_orangtua.required' => 'No Hp Orangtua harus diisi.',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $alamat = $this->request->getPost('alamat');
        $id_kelas = $this->request->getPost('id_kelas');
        $email = $this->request->getPost('email');
        $nis = $this->request->getPost('nis');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $no_hp = $this->request->getPost('no_hp');
        $no_hp_orangtua = $this->request->getPost('no_hp_orangtua');
        $foto = $this->request->getFile('foto');

        // Generate Edit Whatsapp otomatis yaa..
        $no_hp = $this->ubahNomorTelepon($no_hp);
        $no_hp_orangtua = $this->ubahNomorTelepon($no_hp_orangtua);

        if ($foto->isValid() && !$foto->hasMoved()) {

            // Nama File Gambare Pake Nama Sendiri
            $extension = $foto->getClientExtension();
            $namaPengguna = $this->request->getPost('nama');
            $newName = $namaPengguna . '_' . date('dmYHis') . '.' . $extension;

            $foto->move('uploads/siswa/', $newName);

            $data = [
                'nama' => $nama,
                'jk' => $jk,
                'alamat' => $alamat,
                'id_kelas' => $id_kelas,
                'email' => $email,
                'foto' => $newName,
                'nis' => $nis,
                'tgl_lahir' => $tgl_lahir,
                'no_hp' => $no_hp,
                'no_hp_orangtua' => $no_hp_orangtua,
            ];

            $pengecekanData = $model->where('nama', $data['nama'])->where('id_siswa !=')->first();
            if ($pengecekanData) {
                return redirect()->back()->with('error', 'Nama siswa sudah ada dalam database.');
            }

            $pengecekanNIS = $model->where('nis', $data['nis'])->where('id_siswa !=')->first();
            if ($pengecekanNIS) {
                return redirect()->back()->with('error', 'NIS siswa sudah ada dalam database.');
            }

            $pengecekanEmail = $model->where('email', $data['email'])->where('id_siswa !=')->first();
            if ($pengecekanEmail) {
                return redirect()->back()->with('error', 'Email siswa sudah ada dalam database.');
            }

            $pengecekanHP = $model->where('no_hp', $data['no_hp'])->where('id_siswa !=')->first();
            if ($pengecekanHP) {
                return redirect()->back()->with('error', 'No HP siswa sudah ada dalam database.');
            }

            $pengecekanHPOrangtua = $model->where('no_hp_orangtua', $data['no_hp_orangtua'])->where('id_siswa !=')->first();
            if ($pengecekanHPOrangtua) {
                return redirect()->back()->with('error', 'No HP orangtua sudah ada dalam database.');
            }

            $model->insert($data);
            // $id_siswa = $model->getInsertID();

            $password = $nis;
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userData = [
                'email' => $email,
                'password' => $passwordHash,
                'nama' => $nama,
                'role' => 'Siswa',
                'status' => 'Active',
                // 'user_id' => $id_siswa
            ];

            $userModel->insert($userData);

            $id_user = $userModel->getInsertID();

            $model->where('nama', $nama)->set(['id_user' => $id_user])->update();

            return redirect()->to('admin/data-siswa')->with('success', 'Data berhasil ditambahkan beserta dengan generate akun.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah foto. Pastikan Anda mengunggah file gambar (JPEG atau PNG).');
        }
    }

    public function edit($id, $nama)
    {
        $siswaModel = new SiswaModel();
        $model = new KelasModel;
        $kelas = $model->findAll();

        $data = [
            'title'     => 'Edit Data Siswa',
            'active'    => 'siswa',
            'siswa'     => $siswaModel->find($id),
            'kelas'     => $kelas,
        ];

        return view('admin/data-siswa/edit', $data);
    }

    public function update($id)
    {
        $siswaModel = new SiswaModel();
        $userModel = new UserModel();

        $siswa = $siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to(site_url('admin/kelola_siswa'))->with('error', 'Data Siswa tidak ditemukan.');
        }

        $validationRules = [
            'nama' => 'required|max_length[155]',
            'id_kelas' => 'required',
            'jk' => 'required',
            'alamat' => 'required|max_length[255]',
            'email' => 'required|valid_email',
            // 'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png]',
            'nis' => 'required|max_length[10]|min_length[10]',
            'tgl_lahir' => 'required',
            'no_hp' => 'required|max_length[13]|min_length[10]',
            'no_hp_orangtua' => 'required|max_length[13]|min_length[10]',
        ];

        $validationMessages = [
            'nama.required' => 'Nama harus diisi.',
            'jk.required' => 'Jenis kelamin harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'id_kelas.required' => 'Kelas harus dipilih.',
            'email.required' => 'Email harus diisi.',
            'email.valid_email' => 'Email tidak valid.',
            // 'foto.uploaded' => 'Foto harus diunggah.',
            // 'foto.mime_in' => 'Format foto harus JPEG atau PNG.',
            'nis.required' => 'Pekerjaan harus diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi.',
            'nis.required' => 'Nis harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp_orangtua.required' => 'No Hp Orangtua harus diisi.',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');

        if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
            if (!empty($siswa['foto'])) {
                $gandos = 'uploads/siswa/' . $siswa['foto'];
                if (file_exists($gandos)) {
                    unlink($gandos);
                }
            }

            $extension = $foto->getClientExtension();
            $namaPengguna = $this->request->getPost('nama');
            $newName = $namaPengguna . '_' . date('dmYHis') . '.' . $extension;
            $foto->move('uploads/siswa', $newName);
            $data['foto'] = $newName;
        }

        $data['nama'] = $this->request->getPost('nama');
        $data['jk'] = $this->request->getPost('jk');
        $data['alamat'] = $this->request->getPost('alamat');
        $data['id_kelas'] = $this->request->getPost('id_kelas');
        $data['tgl_lahir'] = $this->request->getPost('tgl_lahir');
        $data['nis'] = $this->request->getPost('nis');
        $data['email'] = $this->request->getPost('email');
        $data['no_hp'] = $this->ubahNomorTelepon($this->request->getPost('no_hp'));
        $data['no_hp_orangtua'] = $this->ubahNomorTelepon($this->request->getPost('no_hp_orangtua'));

        $existingSchool = $siswaModel->where('nama', $data['nama'])->where('id_siswa !=', $id)->first();
        if ($existingSchool) {
            return redirect()->back()->with('error', 'Nama Siswa sudah ada dalam database.');
        }

        $pengecekanData = $siswaModel->where('nama', $data['nama'])->where('id_siswa !=', $id)->first();
        if ($pengecekanData) {
            return redirect()->back()->with('error', 'Nama siswa sudah ada dalam database.');
        }

        $pengecekanNIS = $siswaModel->where('nis', $data['nis'])->where('id_siswa !=', $id)->first();
        if ($pengecekanNIS) {
            return redirect()->back()->with('error', 'NIS siswa sudah ada dalam database.');
        }

        $pengecekanEmail = $siswaModel->where('email', $data['email'])->where('id_siswa !=', $id)->first();
        if ($pengecekanEmail) {
            return redirect()->back()->with('error', 'Email siswa sudah ada dalam database.');
        }

        $pengecekanHP = $siswaModel->where('no_hp', $data['no_hp'])->where('id_siswa !=', $id)->first();
        if ($pengecekanHP) {
            return redirect()->back()->with('error', 'No HP siswa sudah ada dalam database.');
        }

        $pengecekanHPOrangtua = $siswaModel->where('no_hp_orangtua', $data['no_hp_orangtua'])->where('id_siswa !=', $id)->first();
        if ($pengecekanHPOrangtua) {
            return redirect()->back()->with('error', 'No HP orangtua sudah ada dalam database.');
        }

        $siswaModel->update($id, $data);

        $nama = $this->request->getPost('nama');
        $id_user = $siswa['id_user'];
        if (!empty($data['email'])) {
            if ($id_user === null || $id_user == 0) {
                $email = $data['email'];
                // $nis = $data['nis'];
                // $password = $nis;
                // $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $userData = [
                    'email' => $email,
                    // 'password' => $passwordHash,
                    'nama' => $data['nama'],
                    'role' => 'Siswa',
                    'status' => 'Active',
                ];

                $id_user = $userModel->insert($userData);
                $id_user = $userModel->getInsertID();
                $siswaModel->where('nama', $nama)->set(['id_user' => $id_user])->update();
            } else {
                $email = $data['email'];
                // $nis = $data['nis'];
                // $password = $nis;
                // $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $userData = [
                    'email' => $email,
                    // 'password' => $passwordHash,
                    'nama' => $data['nama'],
                    'role' => 'Siswa',
                    'status' => 'Active',
                ];

                $userModel->update($id_user, $userData);
            }
        }

        return redirect()->to(site_url('admin/data-siswa'))->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($id)
    {
        $siswaModel = new SiswaModel();
        $dataSiswa = $siswaModel->find($id);

        if ($dataSiswa) {
            $id_user = $dataSiswa['id_user'];

            $siswaModel->delete($id);

            if (!empty($id_user)) {
                $userModel = new UserModel();
                $userModel->delete($id_user);
            }

            $fotoPath = 'uploads/siswa/' . $dataSiswa['foto'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }

            session()->setFlashdata('success', 'Data berhasil dihapus.');
        }

        return redirect()->back();
    }
}
