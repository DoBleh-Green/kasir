<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function admin()
    {
        return view('admin-page.admin');
    }
    function kasir()
    {
        return view('kasir-page.kasir');
    }
}
