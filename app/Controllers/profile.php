<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        // Cek login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'username'   => session()->get('username'),
            'email'      => session()->get('email'),
            'role'       => session()->get('role'),
            'login_time' => session()->get('login_time'),
            'status'     => session()->get('isLoggedIn')
        ];

        return view('profile/index', $data);
    }
}