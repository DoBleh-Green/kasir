<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = barang::all();
        // menampilkan 'admin-page.barang.index'
        return view('admin-page.barang.index', ['barang' => $barang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // menampilkan tempat untuk create 'admin-page.barang.index'
        return view('admin-page.barang.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // back end dari halaman pembuatan data barang baru.
        // Melakukan validasi input dari formulir pembuatan barang
        $data = $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',
            'harga_barang' => 'required',
        ]);

        // Membuat dan menyimpan instansi baru dari model barang (barang)
        $newBarang = barang::create($data);

        // Mengarahkan pengguna kembali ke halaman index barang dengan pesan sukses
        return redirect(route('barang.index'))->with('success-create', 'New Data Has Been Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menggunakan model barang untuk mencari pengguna berdasarkan ID
        $barang = barang::find($id);

        // Mengembalikan tampilan 'admin-page/barang/form_edit' dan menyertakan data pengguna
        return view('admin-page.barang.edit', ['barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Menggunakan model barang untuk mencari pengguna berdasarkan ID
            $barang = barang::findOrFail($id);

            // Validasi input sesuai kebutuhan Anda
            // required | jenis data | panjang huruf
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            // Update informasi pengguna dengan nilai dari request
            $barang->name = $request->name;
            $barang->email = $request->email;

            // Menyimpan perubahan informasi pengguna ke database
            $barang->save();

            // Redirect ke route 'barang.index' dengan ID pengguna dan memberikan pesan sukses
            return redirect()->route('barang.index', $id)->with('success-edit', 'User updated successfully');
        } catch (\Exception $e) {
            // Jika terjadi exception, redirect ke route 'barang.index' dengan ID pengguna dan memberikan pesan error
            return redirect()->route('barang.index', $id)->with('error', 'User update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
