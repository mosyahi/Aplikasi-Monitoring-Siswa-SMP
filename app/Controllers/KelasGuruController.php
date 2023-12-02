<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;

class KelasGuruController extends BaseController
{
    public function index()
    {
        $model = new KelasModel();
        $kelas = $model->findAll();

        $data = [
            'title' => 'Data Kelas',
            'active' => 'kelas',
            'kelas' => $kelas
        ];

        return view('guru/data-kelas/kelas', $data);
    }


    public function add()
    {
        $tingkat = $this->request->getPost('tingkat');
        $tipe_kelas = $this->request->getPost('tipe_kelas');

        $modelKelas = new KelasModel();

        $validationRules = [
            'tingkat' => 'required',
            'tipe_kelas' => 'required',
        ];

        $validationMessages = [
            'tingkat.required' => 'Tingkat kelas harus diisi.',
            'tipe_kelas.required' => 'Tipe kelas harus diisi.',
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'tingkat' => $tingkat,
            'tipe_kelas' => $tipe_kelas,
        ];

        $cekData = $modelKelas->where('tingkat', $userData['tingkat'])
            ->where('tipe_kelas', $userData['tipe_kelas'])
            ->countAllResults();

        if ($cekData > 0) {
            return redirect()->back()->withInput()->with('error', 'Kelas tersebut sudah ada dalam database.');
        }

        $modelKelas->insert($userData);
        session()->setFlashdata('success', 'Data kelas berhasil ditambahkan.');
        return redirect()->back();
    }


    public function update($id)
    {
        $tingkat = $this->request->getPost('tingkat');
        $tipe_kelas = $this->request->getPost('tipe_kelas');

        $modelKelas = new KelasModel();

        $userData = [
            'tingkat' => $tingkat,
            'tipe_kelas' => $tipe_kelas,
        ];

        $cekData = $modelKelas->where('tingkat', $userData['tingkat'])
            ->where('tipe_kelas', $userData['tipe_kelas'])
            ->countAllResults();

        if ($cekData > 0) {
            return redirect()->back()->withInput()->with('error', 'Gagal diperbaharui! Kelas tersebut sudah ada dalam database.');
        }

        $modelKelas->update($id, $userData);
        session()->setFlashdata('success', 'Data kelas berhasil diperbaharui.');
        return redirect()->back();
    }


    public function delete($id)
    {
        $modelKelas = new KelasModel();
        $kelas = $modelKelas->find($id);
        if ($kelas) {
            $modelKelas->delete($id);

            session()->setFlashdata('success', 'Data kelas berhasil dihapus.');
        }
        return redirect()->back();
    }
}
