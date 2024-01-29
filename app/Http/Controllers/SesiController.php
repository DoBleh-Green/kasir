<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SesiController extends Controller
{
    // Jika route 'index' diakses, akan mengembalikan view 'login' dari login.blade.php
    function index()
    {
        return view('login');
    }

    // Fungsi untuk proses login
    function login(Request $request)
    {
        // Melakukan validasi data yang diterima dari request
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib di isi',
            'password.required' => 'Password wajib di isi',
        ]);

        // Mengambil data email dan password dari request
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Memeriksa kecocokan data login menggunakan Auth::attempt
        if (Auth::attempt($infologin)) {
            // Jika berhasil login, arahkan ke halaman sesuai dengan peran (role) pengguna
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->role == 'kasir') {
                return redirect('/kasir');
            }
        } else {
            // Jika login gagal, kembalikan dengan pesan error dan data input sebelumnya
            return redirect('')->withErrors('Email Atau Password tidak sesuai')->withInput();
        }
    }

    // Fungsi untuk proses logout
    function logout()
    {
        // Melakukan logout pengguna dan membersihkan session
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

}

