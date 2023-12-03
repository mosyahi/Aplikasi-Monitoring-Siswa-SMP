<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
// use App\Models\OrtuModel;
use App\Models\SiswaModel;
use App\Models\GuruModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $dataUser = $model->findAll();

        $siswaModel = new SiswaModel();
        // $ortuModel = new OrtuModel();
        $guruModel = new GuruModel();

        foreach ($dataUser as &$user) {
            $id_user = $user['id_user'];

            $siswaData = $siswaModel->getSiswaByUserId($id_user);

            // $ortuData = $ortuModel->getOrtuByUserId($id_user);

            $guruData = $guruModel->getGuruByUserId($id_user);

            $gambarUrls = [];

            if ($siswaData !== null) {
                $gambarUrls['gambar_siswa_url'] = base_url('uploads/siswa/' . $siswaData['foto']);
            } else {
                $gambarUrls['gambar_siswa_url'] = ''; 
            }

            // if ($ortuData !== null) {
            //     $gambarUrls['gambar_ortu_url'] = base_url('uploads/orangtua/' . $ortuData['foto']);
            // } else {
            //     $gambarUrls['gambar_ortu_url'] = ''; 
            // }

            if ($guruData !== null) {
                $gambarUrls['gambar_guru_url'] = base_url('uploads/guru/' . $guruData['foto']);
            } else {
                $gambarUrls['gambar_guru_url'] = ''; 
            }

            $user['gambar_url'] = $gambarUrls;
        }

        $data = [
            'title' => 'Data Users',
            'active' => 'users',
            'dataUser' => $dataUser,
        ];
        return view('admin/users/index', $data);
    }

    public function add()
    {
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userModel = new UserModel();

        $userData = [
            'nama' => $nama,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'Admin',
            'status' => $status,
        ];

        $cekEmail = $userModel->where('email', $userData['email'])->first();
        if ($cekEmail) {
            return redirect()->back()->with('error', 'Email sudah ada dalam database.');
        }

        $userModel->insert($userData);
        session()->setFlashdata('success', 'Data Pengguna berhasil ditambahkan.');
        return redirect()->back();
    }

    public function update($id)
    {
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $status = $this->request->getPost('status');

        $userModel = new UserModel();
        $siswaModel = new SiswaModel();
        // $ortuModel = new OrtuModel();
        $guruModel = new GuruModel();

        $userData = [
            'nama' => $nama,
            'email' => $email,
            'status' => $status,
        ];

        $cekEmail = $userModel->where('email', $userData['email'])->first();
        if ($cekEmail && $cekEmail['id_user'] !== $id) {
            return redirect()->back()->with('error', 'Email sudah ada dalam database.');
        }

        $userModel->update($id, $userData);

        // Perbarui data siswa terkait
        $siswa = $siswaModel->where('id_user', $id)->first();
        if ($siswa) {
            $siswaData = [
                'nama' => $nama,
                'email' => $email,
            ];
            $siswaModel->update($siswa['id_siswa'], $siswaData);
        }

        // $ortu = $ortuModel->where('id_user', $id)->first();
        // if ($ortu) {
        //     $ortuData = [
        //         'nama' => $nama,
        //         'email' => $email,
        //     ];
        //     $ortuModel->update($ortu['id_ortu'], $ortuData);
        // }

        $guru = $guruModel->where('id_user', $id)->first();
        if ($guru) {
            $guruData = [
                'nama' => $nama,
                'email' => $email,
            ];
            $guruModel->update($guru['id_guru'], $guruData);
        }

        session()->setFlashdata('success', 'Data pengguna berhasil diperbaharui.');
        return redirect()->back();
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
        // Temukan data ortu yang terkait
            // $ortuModel = new OrtuModel();
            // $ortu = $ortuModel->where('id_user', $id)->first();

            // if ($ortu) {
            // // Hapus data ortu yang terkait
            //     $ortuModel->update($ortu['id_ortu'], [
            //         'email' => null,
            //         'id_user' => null,
            //         'sbg' => null
            //     ]);
            // }

            // Temukan data siswa yang terkait
            $siswaModel = new SiswaModel();
            $siswa = $siswaModel->where('id_user', $id)->first();

            if ($siswa) {
            // Hapus data siswa yang terkait
                $siswaModel->update($siswa['id_siswa'], [
                    'email' => null,
                    'id_user' => null,
                    'nis' => null
                ]);
            }

            // Temukan data guru yang terkait
            $guruModel = new GuruModel();
            $guru = $guruModel->where('id_user', $id)->first();

            if ($guru) {
            // Hapus data guru yang terkait
                $guruModel->update($guru['id_guru'], [
                    'email' => null,
                    'id_user' => null,
                    'nip' => null
                ]);
            }

            // Hapus user
            $userModel->delete($id);

            session()->setFlashdata('success', 'Data pengguna berhasil dihapus beserta data terkait.');
        }

        return redirect()->back();
    }


}
