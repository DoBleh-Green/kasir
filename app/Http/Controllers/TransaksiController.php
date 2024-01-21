<?php
namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $barang = barang::all();
        return view('kasir-page.kasir', ['barang' => $barang]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform the search query on your model
        $barang = barang::where('nama_barang', 'like', '%' . $query . '%')
            ->orWhere('stok', 'like', '%' . $query . '%')
            ->orWhere('harga_barang', 'like', '%' . $query . '%')
            ->get();

        return view('kasir-page.kasir', compact('barang'));
    }
}
