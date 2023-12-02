<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\OrtuModel;
use App\Models\GuruModel;
use App\Models\GoogleModel;
use Config\OAuth2;

class AuthController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login User'
        ];
        return view('auth/login', $data);
    }

    public function index2()
    {
        $data = [
            'title' => 'Login User'
        ];
        return view('auth/login-dark', $data);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] == 'Active') {
                $session = \Config\Services::session();
                $session->set('auth', true);
                $session->set('nama', $user['nama']);
                $session->set('email', $user['email']);
                $session->set('role', $user['role']);
                $session->set('status', $user['status']);
                $session->set('id_user', $user['id_user']);

                if ($user['role'] == 'Siswa') {
                    $siswaModel = new SiswaModel();
                    $siswaData = $siswaModel->getSiswaByUserId($user['id_user']);
                    if ($siswaData) {
                        $session->set('foto_url', base_url('uploads/siswa/' . $siswaData['foto']));
                        $session->set('siswa_id', $siswaData['id_siswa']);
                    }
                    return redirect()->to('siswa/dashboard')->with('success', 'Login Berhasil.');
                }

                if ($user['role'] == 'Orangtua') {
                    $ortuModel = new OrtuModel();
                    // $siswaModel = new SiswaModel();
                    $ortuData = $ortuModel->getOrtuByUserId($user['id_user']);
                    // $siswaData = $siswaModel->getSiswaByUserId($user['id_user']);
                    if ($ortuData) {
                        $session->set('foto_url', base_url('uploads/orangtua/' . $ortuData['foto']));
                        $session->set('ortu_id', $ortuData['id_ortu']);
                        // $session->set('siswa_id', $siswaData['id_siswa']);
                    }
                    return redirect()->to('orangtua/dashboard')->with('success', 'Login Berhasil.');
                }

                if ($user['role'] == 'Guru') {
                    $guruModel = new GuruModel();
                    $guruData = $guruModel->getGuruByUserId($user['id_user']);
                    if ($guruData) {
                        $session->set('foto_url', base_url('uploads/guru/' . $guruData['foto']));
                        $session->set('guru_id', $guruData['id_guru']);
                    }
                    return redirect()->to('guru/dashboard')->with('success', 'Login Berhasil.');
                }

                return redirect()->to('admin/dashboard')->with('success', 'Login Berhasil.');
            } else {
                // Akun tidak aktif
                $session = \Config\Services::session();
                $session->setFlashdata('error-2', 'Akun Anda tidak aktif. Silahkan hubungi <a href="https://wa.me/628988658838" target="blank" class="text-primary">&nbsp;Admin</a>');
                return redirect()->back();
            }
        }

        $session = \Config\Services::session();
        $session->setFlashdata('error-2', 'Email atau Password Anda Salah');
        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
