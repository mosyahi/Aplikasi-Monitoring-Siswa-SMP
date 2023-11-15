<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\JurusanModel;
use App\Models\OrtuModel;
use App\Models\UserModel;

class OrtuController extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $model = new OrtuModel();
        $modelSiswa = new SiswaModel();
        $orangtua = $model->findAll();
        $siswa = $modelSiswa->findAll();
        $data = [
            'title' => 'Data Siswa',
            'active' => 'orangtua',
            'orangtua' => $orangtua,
            'siswa' => $siswa
        ];
        return view('admin/data-orangtua/index', $data);
    }

    public function new()
    {
        $model = new SiswaModel();
        $modelKelas = new KelasModel();
        $siswa = $model->findAll();
        $kelas = $model->findAll();

        $data = [
            'title' => 'Add Orang Tua',
            'active' => 'orangtua',
            'siswa' => $siswa,
        ];
        return view('admin/data-orangtua/new', $data);
    }

    public function add()
    {
        $model = new OrtuModel();
        $userModel = new UserModel();

        $validationRules = [
            'nama' => 'required',
            'id_siswa' => 'required',
            'email' => 'required|valid_email',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png]',
            'pekerjaan' => 'required',
            'sbg' => 'required',
            'alamat' => 'required',
        ];

        $validationMessages = [
            'nama.required' => 'Nama harus diisi.',
            'id_siswa.required' => 'Siswa harus dipilih.',
            'email.required' => 'Email harus diisi.',
            'email.valid_email' => 'Email tidak valid.',
            'foto.uploaded' => 'Foto harus diunggah.',
            'foto.mime_in' => 'Format foto harus JPEG atau PNG.',
            'pekerjaan.required' => 'Pekerjaan harus diisi.',
            'sbg.required' => 'Status pekerjaan harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama = $this->request->getPost('nama');
        $id_siswa = $this->request->getPost('id_siswa');
        $email = $this->request->getPost('email');
        $pekerjaan = $this->request->getPost('pekerjaan');
        $sbg = $this->request->getPost('sbg');
        $alamat = $this->request->getPost('alamat');

        $foto = $this->request->getFile('foto');

        if ($foto->isValid() && !$foto->hasMoved()) {

        // Nama File Gambar Pake Nama Sendiri Anjing
           $extension = $foto->getClientExtension();
           $namaPengguna = $this->request->getPost('nama');
           $newName = $namaPengguna . '_' . date('dmYHis') . '.' . $extension;

           $foto->move('uploads/orangtua/', $newName);

           $data = [
            'nama' => $nama,
            'id_siswa' => $id_siswa,
            'email' => $email,
            'foto' => $newName,
            'pekerjaan' => $pekerjaan,
            'sbg' => $sbg,
            'alamat' => $alamat,
        ];
        $model->insert($data);

        $password = $sbg . '.123';
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $userData = [
            'email' => $email,
            'password' => $passwordHash,
            'nama' => $nama,
            'role' => 'Orang Tua',
            'status' => 'Active',
        ];

        $userModel->insert($userData);

        $id_user = $userModel->getInsertID();

        $model->where('nama', $nama)->set(['id_user' => $id_user])->update();

        return redirect()->to('admin/data-orangtua')->with('success', 'Data berhasil ditambahkan beserta dengan generate akun.');
    } else {
        return redirect()->back()->with('error', 'Gagal mengunggah foto. Pastikan Anda mengunggah file gambar (JPEG atau PNG).');
    }
}

public function edit($id)
{
    $model = new OrtuModel();
    $modelSiswa = new SiswaModel();
    $dataOrtu = $model->find($id);
    $siswa = $modelSiswa->findAll();
    $data = [
        'title' => 'Edit Orang Tua',
        'active' => 'orangtua',
        'orangtua' => $dataOrtu,
        'siswa' => $siswa,
    ];
    return view('admin/data-orangtua/edit', $data);
}

public function update($id)
{
    $model = new OrtuModel();
    $userModel = new UserModel();

    $dataOrangtua = $model->find($id);

    $validationRules = [
        'nama' => 'required',
        'id_siswa' => 'required',
        'email' => 'required|valid_email',
        'pekerjaan' => 'required',
        'sbg' => 'required',
        'alamat' => 'required',
    ];

    $validationMessages = [
        'nama.required' => 'Nama harus diisi.',
        'id_siswa.required' => 'Siswa harus dipilih.',
        'email.required' => 'Email harus diisi.',
        'email.valid_email' => 'Email tidak valid.',
        'pekerjaan.required' => 'Pekerjaan harus diisi.',
        'sbg.required' => 'Status pekerjaan harus diisi.',
        'alamat.required' => 'Alamat harus diisi.',
    ];

    if (!$this->validate($validationRules, $validationMessages)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
        'nama' => $this->request->getPost('nama'),
        'id_siswa' => $this->request->getPost('id_siswa'),
        'email' => $this->request->getPost('email'),
        'pekerjaan' => $this->request->getPost('pekerjaan'),
        'sbg' => $this->request->getPost('sbg'),
        'alamat' => $this->request->getPost('alamat'),
    ];

    $foto = $this->request->getFile('foto');
    if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {

            // Hapus Foto Lama
        if (!empty($dataOrangtua['foto'])) {
            $fotoPath = 'uploads/orangtua/' . $dataOrangtua['foto'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $extension = $foto->getClientExtension();
        $namaPengguna = $this->request->getPost('nama');
        $newName = $namaPengguna . '_' . date('dmYHis') . '.' . $extension;
        $foto->move('uploads/orangtua', $newName);
        $data['foto'] = $newName;
    }

    $model->update($id, $data);

    $nama = $this->request->getPost('nama');
    $id_user = $dataOrangtua['id_user'];
    // Check jika email atau nis tidak null
    if (!empty($data['email']) || !empty($data['sbg'])) {
    // Jika salah satu atau keduanya tidak null
        if ($id_user === null || $id_user == 0) {
        // Jika id_user awalnya null atau 0, buat id_user baru
            $email = $data['email'];
            $sbg = $data['sbg'];
            $password = $sbg . '.123';
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userData = [
                'email' => $email,
                'password' => $passwordHash,
                'nama' => $data['nama'],
                'role' => 'Orang Tua',
                'status' => 'Active',
            ];

            $id_user = $userModel->insert($userData);
            $id_user = $userModel->getInsertID();
            $model->where('nama', $nama)->set(['id_user' => $id_user])->update();
        } else {
        // Jika id_user sudah ada, update data user yang sudah ada
            $email = $data['email'];
            $sbg = $data['sbg'];
            $password = $sbg . '.123';
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userData = [
                'email' => $email,
                'password' => $passwordHash,
                'nama' => $data['nama'],
                'role' => 'Orang Tua',
                'status' => 'Active',
            ];

            $userModel->update($id_user, $userData);
        }
    }

    return redirect()->to('admin/data-orangtua')->with('success', 'Data berhasil diperbaharui beserta dengan generate akun.');
}

public function delete($id)
{
    $siswaModel = new OrtuModel();
    $siswa = $siswaModel->find($id);

    if ($siswa) {
        $id_user = $siswa['id_user'];

        $siswaModel->delete($id);

        if (!empty($id_user)) {
            $userModel = new UserModel();
            $userModel->delete($id_user);
        }

        $fotoPath = 'uploads/orangtua/' . $siswa['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }

        session()->setFlashdata('success', 'Data berhasil dihapus.');
    }

    return redirect()->back();
}

}
