<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\GuruModel;

class GuruController extends BaseController
{
    public function index()
    {
        $model = new GuruModel;
        $guru = $model->findAll();

        $data = [
            'title' => 'Data Guru',
            'active' => 'guru',
            'guru' => $guru,
        ];

        return view('admin/data-guru/index', $data);
    }

    public function new()
    {
        $data = [
            'title'     => 'Add Guru',
            'active'    => 'guru',
        ];
        return view('admin/data-guru/new', $data);
    }

    public function add()
    {
        $model = new GuruModel();
        $userModel = new UserModel();

        $validationRules = [
            'nama' => 'required|max_length[155]',
            'email' => 'required|valid_email',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png]',
            'nip' => 'required|min_length[10]|max_length[10]',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required|max_length[50]',
            'jk' => 'required',
        ];

        $validationMessages = [
            'nama.required' => '',
            'email.required' => '',
            'email.valid_email' => '',
            'foto.uploaded' => '',
            'foto.mime_in' => '',
            'nip.required' => '',
            'tanggal_lahir.required' => '',
            'tempat_lahir.required' => '',
            'jk.required' => '',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $nip = $this->request->getPost('nip');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $jk = $this->request->getPost('jk');
        $foto = $this->request->getFile('foto');

        if ($foto->isValid() && !$foto->hasMoved()) {

        // Nama File Gambar Pake Nama Sendiri
         $extension = $foto->getClientExtension();
         $namaPengguna = $this->request->getPost('nama');
         $newName = $namaPengguna . '_' . date('dmYHis') . '.' . $extension;

         $foto->move('uploads/guru/', $newName);

         $data = [
            'nama' => $nama,
            'email' => $email,
            'foto' => $newName,
            'nip' => $nip,
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jk' => $jk,
        ];

        $pengecekanData = $model->where('nama', $data['nama'])->where('id_guru !=')->first();
        if ($pengecekanData) {
            return redirect()->back()->with('error', 'Nama guru sudah ada dalam database.');
        }

        $pengecekanNIP = $model->where('nip', $data['nip'])->where('id_guru !=')->first();
        if ($pengecekanNIP) {
            return redirect()->back()->with('error', 'NIP guru sudah ada dalam database.');
        }

        $pengecekanEmail = $model->where('email', $data['email'])->where('id_guru !=')->first();
        if ($pengecekanEmail) {
            return redirect()->back()->with('error', 'Email guru sudah ada dalam database.');
        }

        $model->insert($data);

        $password = $nip;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $userData = [
            'email' => $email,
            'password' => $passwordHash,
            'nama' => $nama,
            'role' => 'Guru',
            'status' => 'Active',
        ];

        $userModel->insert($userData);

        $id_user = $userModel->getInsertID();

        $model->where('nama', $nama)->set(['id_user' => $id_user])->update();

        return redirect()->to('admin/data-guru')->with('success', 'Data berhasil ditambahkan beserta dengan generate akun.');
    } else {
        return redirect()->back()->with('error', 'Gagal mengunggah foto. Pastikan Anda mengunggah file gambar (JPEG atau PNG).');
    }
}

public function edit($id, $nama)
{
    $guru = new GuruModel();

    $data = [
        'title'     => 'Edit Guru',
        'active'    => 'guru',
        'guru'     => $guru->find($id),
    ];

    return view('admin/data-guru/edit', $data);
}

public function update($id)
{
    $guruModel = new GuruModel();
    $userModel = new UserModel();

    $guru = $guruModel->find($id);

    if (!$guru) {
        return redirect()->to(site_url('admin/data-guru'))->with('error', 'Data guru tidak ditemukan.');
    }

    $validationRules = [
        'nama' => 'required|max_length[155]',
        'email' => 'required|valid_email',
        // 'foto' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/png]',
        'nip' => 'required|min_length[10]|max_length[10]',
        'tanggal_lahir' => 'required',
        'tempat_lahir' => 'required|max_length[50]',
        'jk' => 'required',
    ];

    $validationMessages = [
        'nama.required' => '',
        'email.required' => '',
        'email.valid_email' => '',
        // 'foto.uploaded' => '',
        // 'foto.mime_in' => '',
        'nip.required' => '',
        'tanggal_lahir.required' => '',
        'tempat_lahir.required' => '',
        'jk.required' => '',
    ];

    if (!$this->validate($validationRules, $validationMessages)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $foto = $this->request->getFile('foto');
    if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
        if (!empty($guru['foto'])) {
            $gandos = 'uploads/guru/' . $guru['foto'];
            if (file_exists($gandos)) {
                unlink($gandos);
            }
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

    $pengecekanData = $guruModel->where('nama', $data['nama'])->where('id_guru !=', $id)->first();
    if ($pengecekanData) {
        return redirect()->back()->with('error', 'Nama guru sudah ada dalam database.');
    }

    $pengecekanNIP = $guruModel->where('nip', $data['nip'])->where('id_guru !=', $id)->first();
    if ($pengecekanNIP) {
        return redirect()->back()->with('error', 'NIP guru sudah ada dalam database.');
    }

    $pengecekanEmail = $guruModel->where('email', $data['email'])->where('id_guru !=', $id)->first();
    if ($pengecekanEmail) {
        return redirect()->back()->with('error', 'Email guru sudah ada dalam database.');
    }

    $guruModel->update($id, $data);

    $nama = $this->request->getPost('nama');
    $id_user = $guru['id_user'];
    if (!empty($data['email'])) {
        if ($id_user === null || $id_user == 0) {
            $email = $data['email'];
            // $nip = $data['nip'];
            // $password = $nip;
            // $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userData = [
                'email' => $email,
                // 'password' => $passwordHash,
                'nama' => $data['nama'],
                'role' => 'Guru',
                'status' => 'Active',
            ];

            $id_user = $userModel->insert($userData);
            $id_user = $userModel->getInsertID();
            $guruModel->where('nama', $nama)->set(['id_user' => $id_user])->update();
        } else {
            $email = $data['email'];
            // $nip = $data['nip'];
            // $password = $nip;
            // $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userData = [
                'email' => $email,
                // 'password' => $passwordHash,
                'nama' => $data['nama'],
                'role' => 'Guru',
                'status' => 'Active',
            ];

            $userModel->update($id_user, $userData);
        }
    }

    return redirect()->to(site_url('admin/data-guru'))->with('success', 'Data guru berhasil diperbarui.');
}

public function delete($id)
{
    $guruModel = new GuruModel();
    $guru = $guruModel->find($id);

    if ($guru) {
        $id_user = $guru['id_user'];

        $guruModel->delete($id);

        if (!empty($id_user)) {
            $userModel = new UserModel();
            $userModel->delete($id_user);
        }

        $fotoPath = 'uploads/guru/' . $guru['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }

        session()->setFlashdata('success', 'Data berhasil dihapus.');
    }

    return redirect()->back();
}
}
