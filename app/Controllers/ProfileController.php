<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\GuruModel;

class ProfileController extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    protected $userModel;
    protected $guruModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->guruModel = new GuruModel();
        $this->userModel = new UserModel();
    }

    public function profile()
    {
        $model = $this->userModel;
        $guru = $this->guruModel;
        $siswa = $this->siswaModel;
        $kelas = $this->kelasModel->findAll();
        $email = session()->get('email');
        $user = session()->get('id_user');
        $userData = $model->where('email', $email)->first();
        $guruData = $guru->getGuruByUserId($user);
        $siswaData = $siswa->getSiswaByUserId($user);

        $data = [
            'title' => 'Profile',
            'active' => 'profile',
            'userData' => $userData,
            'guruData' => $guruData,
            'siswaData' => $siswaData,
            'kelas' => $kelas,
        ];

        $session = \Config\Services::session();
        if ($session->get('role') == 'Admin') {
            return view('admin/profile', $data);
        } elseif ($session->get('role') == 'Guru') {
            return view('guru/profile', $data);
        } elseif ($session->get('role') == 'Siswa') {
            return view('siswa/profile', $data);
        }
    }

    public function updateProfile($id)
    {
        $userRole = session()->get('role');

        // ROLE GURU
        switch ($userRole) {
            case 'Guru':
            $guruModel = new GuruModel();
            $userModel = new UserModel();

            $guru = $guruModel->find($id);

            if (!$guru) {
                return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
            }

            $foto = $this->request->getFile('foto');
            if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
                if (!empty($guru['foto'])) {
                    unlink('uploads/guru/' . $guru['foto']);
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

            $id_user = $guru['id_user'];
            if (!empty($data['email'])) {
                if ($id_user === null || $id_user == 0) {
                    $email = $data['email'];

                    $userData = [
                        'email' => $email,
                        'nama' => $data['nama'],
                        'role' => 'Guru',
                        'status' => 'Active',
                    ];

                    $id_user = $userModel->insert($userData);
                    $id_user = $userModel->getInsertID();
                    $guruModel->where('nama', $nama)->set(['id_user' => $id_user])->update();
                } else {
                    $email = $data['email'];

                    $userData = [
                        'email' => $email,
                        'nama' => $data['nama'],
                        'role' => 'Guru',
                        'status' => 'Active',
                    ];

                    $userModel->update($id_user, $userData);
                }
            }

            return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
            break;

            // ROLE SISWA
            case 'Siswa':
            $siswaModel = new SiswaModel();
            $userModel = new UserModel();

            $siswa = $siswaModel->find($id);

            if (!$siswa) {
                return redirect()->back()->with('error', 'Data Siswa tidak ditemukan.');
            }

            $validationRules = [
                'nama' => 'required|max_length[155]',
                'jk' => 'required',
                'alamat' => 'required|max_length[255]',
                'email' => 'required|valid_email',
                'nis' => 'required|max_length[10]|min_length[10]',
                'tgl_lahir' => 'required',
                'no_hp' => 'required|max_length[13]|min_length[10]',
                'no_hp_orangtua' => 'required|max_length[13]|min_length[10]',
            ];

            $validationMessages = [
                'nama.required' => 'Nama harus diisi.',
                'jk.required' => 'Jenis kelamin harus diisi.',
                'alamat.required' => 'Alamat harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.valid_email' => 'Email tidak valid.',
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

                    $userData = [
                        'email' => $email,
                        'nama' => $data['nama'],
                        'role' => 'Siswa',
                        'status' => 'Active',
                    ];

                    $id_user = $userModel->insert($userData);
                    $id_user = $userModel->getInsertID();
                    $siswaModel->where('nama', $nama)->set(['id_user' => $id_user])->update();
                } else {
                    $email = $data['email'];

                    $userData = [
                        'email' => $email,
                        'nama' => $data['nama'],
                        'role' => 'Siswa',
                        'status' => 'Active',
                    ];

                    $userModel->update($id_user, $userData);
                }
            }

            return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
        }
    }

    private function ubahNomorTelepon($nomor) {
        if (substr($nomor, 0, 2) === '08') {
            $nomor = '628' . substr($nomor, 2);
        } elseif (substr($nomor, 0, 3) === '+62') {
            $nomor = '62' . substr($nomor, 3);
        }

        return $nomor;
    }

    public function password($id_user)
    {
        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasiPassword = $this->request->getPost('konfirmasi_password');

        if ($passwordLama === $passwordBaru) {
            return redirect()->back()->with('error', 'Password lama dan password baru tidak boleh sama');
        }

        $validationRules = [
            'password_lama' => 'required',
            'password_baru' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
            'konfirmasi_password' => 'required|matches[password_baru]'
        ];

        $validationMessages = [
            'password_baru.regex_match' => ''
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new \App\Models\UserModel(); 
        $userData = $model->find($id_user);

        if (!$userData || !password_verify($passwordLama, $userData['password'])) {
            return redirect()->back()->with('error', 'Password lama salah');
        }

        if ($passwordBaru !== $konfirmasiPassword) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok');
        }

        $model->update($id_user, ['password' => password_hash($passwordBaru, PASSWORD_DEFAULT)]);

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}
