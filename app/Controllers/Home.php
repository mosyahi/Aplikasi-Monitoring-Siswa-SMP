<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Login User'
        ];
        return view('auth/login', $data);
    }
}
