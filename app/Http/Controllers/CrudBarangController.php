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
    public function index(Request $request)
    {
        // Mengambil semua data barang dari model 'Barang'
        $barang = Barang::all();

        // Mengambil nilai parameter query 'sort' dari request, defaultnya adalah 'none'
        $sort = $request->query('sort', 'none');

        // Memeriksa nilai 'sort' untuk menentukan pengurutan data
        if ($sort === 'desc') {
            // Jika 'sort' adalah 'desc', mengambil data barang dan mengurutkannya berdasarkan kolom 'stok' secara descending
            $barang = Barang::orderBy('stok', 'desc')->get();
        } elseif ($sort === 'asc') {
            // Jika 'sort' adalah 'asc', mengambil data barang dan mengurutkannya berdasarkan kolom 'stok' secara ascending
            $barang = Barang::orderBy('stok', 'asc')->get();
        } else {
            // Jika 'sort' bukan 'desc' atau 'asc', menggunakan urutan asli dari data barang
            $barang = Barang::all();
        }

        // Menampilkan data barang ke dalam view 'admin-page.barang.index'
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
    public function edit($id)
    {
        $data = barang::where('id', $id)->first();
        return view('admin-page.barang.edit')->with('data', $data);
        // // Menggunakan model barang untuk mencari pengguna berdasarkan ID
        // $barang = barang::find($id_barang);

        // // Mengembalikan tampilan 'admin-page/barang/form_edit' dan menyertakan data pengguna
        // return view('admin-page.barang.edit', ['barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga_barang' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            // Sesuaikan dengan aturan validasi yang sesuai dengan kebutuhan Anda
        ]);

        // Temukan data barang berdasarkan $id
        $barang = Barang::findOrFail($id);

        // Update data barang
        $barang->update([
            'nama_barang' => $request->input('nama_barang'),
            'stok' => $request->input('stok'),
            'harga_barang' => $request->input('harga_barang'),
            // Sesuaikan dengan nama kolom dalam model Anda
        ]);

        // Redirect ke halaman yang sesuai atau berikan pesan sukses
        return redirect()->route('barang.index')->with('success-edit', 'Data barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = barang::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$barang) {
            return abort(404); // Not Found
        }

        // Hapus pengguna
        $barang->delete();

        // Tetapkan pesan sukses atau sesuai dengan kebutuhan Anda
        $message = 'User with ID ' . $id . ' has been deleted.';

        // Redirect kembali ke halaman yang sama dengan menyertakan pesan sukses
        return redirect('/admin/barang')->with('success-delete', $message);

    }


}
