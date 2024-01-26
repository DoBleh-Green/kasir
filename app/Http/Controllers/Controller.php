<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function viewCart()
    {
        // Retrieve the name of the logged-in user (cashier)
        $nama_kasir = Auth::user()->name;

        // Print or echo the cashier's name
        echo "Welcome, $nama_kasir!";

        // You can also return the name as a response if needed
        // return response("Welcome, $nama_kasir!");
    }
}
