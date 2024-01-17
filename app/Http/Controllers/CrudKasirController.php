<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CrudKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengguna (kasir) dari model User
        $users = User::all();

        // Mengembalikan tampilan 'admin-page.kasir.index' dengan data pengguna
        return view('admin-page.kasir.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan halaman pembuatan data kasir baru.
        return view('admin-page.kasir.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // back end dari halaman pembuatan data kasir baru.
        // Melakukan validasi input dari formulir pembuatan kasir
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Membuat dan menyimpan instansi baru dari model User (kasir)
        $newKasir = User::create($data);

        // Mengarahkan pengguna kembali ke halaman index kasir dengan pesan sukses
        return redirect(route('kasir.index'))->with('success-create', 'New Data Has Been Added');
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
        // Menggunakan model User untuk mencari pengguna berdasarkan ID
        $user = User::find($id);

        // Mengembalikan tampilan 'admin-page/kasir/form_edit' dan menyertakan data pengguna
        return view('admin-page.kasir.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Menggunakan model User untuk mencari pengguna berdasarkan ID
            $user = User::findOrFail($id);

            // Validasi input sesuai kebutuhan Anda
            // required | jenis data | panjang huruf
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            // Update informasi pengguna dengan nilai dari request
            $user->name = $request->name;
            $user->email = $request->email;

            // Menyimpan perubahan informasi pengguna ke database
            $user->save();

            // Redirect ke route 'kasir.index' dengan ID pengguna dan memberikan pesan sukses
            return redirect()->route('kasir.index', $id)->with('success-edit', 'User updated successfully');
        } catch (\Exception $e) {
            // Jika terjadi exception, redirect ke route 'kasir.index' dengan ID pengguna dan memberikan pesan error
            return redirect()->route('kasir.index', $id)->with('error', 'User update failed');
        }
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $user = User::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$user) {
            return abort(404); // Not Found
        }

        // Hapus pengguna
        $user->delete();

        // Tetapkan pesan sukses atau sesuai dengan kebutuhan Anda
        $message = 'User with ID ' . $id . ' has been deleted.';

        // Redirect kembali ke halaman yang sama dengan menyertakan pesan sukses
        return redirect('/admin/kasir')->with('success-delete', $message);
    }

}
