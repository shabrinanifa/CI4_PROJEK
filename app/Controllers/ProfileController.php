<?php

namespace App\Controllers;

class ProfileController extends BaseController
{
    public function index()
    {
        $data = [
            'title'      => 'Profile Information',
            'username'   => session()->get('username') ?? 'Guest',
            'role'       => session()->get('role') ?? '-',
            'email'      => session()->get('email') ?? 'Belum diset',
            'login_time' => session()->get('login_time') ?? '-',
            'status'     => 'Sudah Login'
        ];

        return view('v_profile', $data);
    }
}