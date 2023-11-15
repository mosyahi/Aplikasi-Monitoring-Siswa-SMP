<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\UserModel;

class SiswaController extends BaseController
{
    public function index()
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
            'title' => 'Data Siswa',
            'active' => 'siswa',
            'siswa' => $siswa,
            'kelas' => $kelas,
            'kelasSiswa' => $kelasSiswa,
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

        return view('admin/data-kelas/anggota', $data);
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

    public function add()
    {
        $model = new SiswaModel();
        $userModel = new UserModel();

        $validationRules = [
            'nama' => 'required',
            'id_kelas' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required|valid_email',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png]',
            'nis' => 'required',
            'tgl_lahir' => 'required',
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
        $foto = $this->request->getFile('foto');

        if ($foto->isValid() && !$foto->hasMoved()) {

        // Nama File Gambar Pake Nama Sendiri Anjing
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
        ];

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

public function edit($id)
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

    $foto = $this->request->getFile('foto');

    if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
        if (!empty($siswa['foto'])) {
            unlink('uploads/siswa/' . $siswa['foto']);
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

    $existingSchool = $siswaModel->where('nama', $data['nama'])->where('id_siswa !=', $id)->first();
    if ($existingSchool) {
        return redirect()->back()->with('error', 'Nama Siswa sudah ada dalam database.');
    }

    $siswaModel->update($id, $data);

    $nama = $this->request->getPost('nama');
    $id_user = $siswa['id_user'];
    if (!empty($data['email']) || !empty($data['nis'])) {
        if ($id_user === null || $id_user == 0) {
            $email = $data['email'];
            $nis = $data['nis'];
            $password = $nis;
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userData = [
                'email' => $email,
                'password' => $passwordHash,
                'nama' => $data['nama'],
                'role' => 'Siswa',
                'status' => 'Active',
            ];

            $id_user = $userModel->insert($userData);
            $id_user = $userModel->getInsertID();
            $siswaModel->where('nama', $nama)->set(['id_user' => $id_user])->update();
        } else {
            $email = $data['email'];
            $nis = $data['nis'];
            $password = $nis;
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userData = [
                'email' => $email,
                'password' => $passwordHash,
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
    $siswa = $siswaModel->find($id);

    if (!$siswa) {
        return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
    }

    $fotoPath = 'uploads/siswa/' . $siswa['foto'];
    if (file_exists($fotoPath)) {
        unlink($fotoPath);
    }

    $siswaModel->delete($id);

    return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
}
}
