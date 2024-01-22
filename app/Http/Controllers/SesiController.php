<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SesiController extends Controller
{
    // function jika ia membaca get index dari routes web ia akan mengeluarkan view page login dari login.blade.php
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $validatedData = $request->validate(
            [
                /* required disini untuk menunjukan suatu filed harus di isi sama dengan
                  required di html bedanya disini kita bisa membuat pesannya sendiri */
                'email' => 'required',
                'password' => 'required',
            ],
            [
                // pengeluaran pesan untuk require
                'email.required' => 'Email wajib di isi',
                'password.required' => 'Password wajib di isi',
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->role == 'kasir') {
                return redirect('/kasir');
            }
        } else {
            // untuk menunjukan erorr juka user memasukan salah satu nya benar dan jika salah mengeluarkan errors dengan input nya tidak terhapus
            return redirect('')->withErrors('Email Atau Password tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

}

