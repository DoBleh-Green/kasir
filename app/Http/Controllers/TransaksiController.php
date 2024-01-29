<?php
namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Struk;
use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    public function index()
    {
        $barang = barang::all();
        return view('kasir-page.kasir', ['barang' => $barang]);
    }

    public function findCartItemIndex($cart, $id)
    {
        foreach ($cart as $index => $item) {
            if ($item['id'] == $id) {
                return $index;
            }
        }

        return false; // Mengembalikan false jika item tidak ditemukan dalam keranjang
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Melakukan pencarian query pada model barang
        $barang = barang::where('nama_barang', 'like', '%' . $query . '%')
            ->orWhere('stok', 'like', '%' . $query . '%')
            ->orWhere('harga_barang', 'like', '%' . $query . '%')
            ->get();

        // Memeriksa apakah ada data yang ditemukan
        if ($barang->isEmpty()) {
            $message_missing = 'Barang tidak ditemukan.';
        } else {
            $message_missing = null;
        }

        return view('kasir-page.kasir', compact('barang', 'message_missing'));
    }

    // Fungsi untuk menambahkan barang ke dalam keranjang
    public function addToCart(Request $request, $id)
    {
        $barang = barang::find($id);

        if (!$barang) {
            // return redirect('/kasir')->with('error', 'Produk tidak ditemukan.');
        }

        //mengambil cart dari session
        $cart = Session::get('cart', []);

        $existingItemIndex = $this->findCartItemIndex($cart, $barang->id);

        if ($existingItemIndex !== false) {
            // Jika item sudah ada dalam keranjang, tambahkan jumlahnya
            $cart[$existingItemIndex]['quantity']++;

            // Perbarui stok hanya untuk item baru yang ditambahkan ke keranjang
            $this->updateStock($barang->id, 1);

        } else {
            // Jika item belum ada dalam keranjang, tambahkan
            $cart[] = [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'quantity' => 1,
                'harga' => $barang->harga_barang,
            ];

            // Perbarui stok hanya untuk item baru yang ditambahkan ke keranjang
            $this->updateStock($barang->id, 1);
        }

        //membuat cart ke session
        Session::put('cart', $cart);

        return redirect('/kasir')->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }

    // Fungsi untuk menghapus barang dari keranjang
    public function removeFromCart($id)
    {
        //mengambil cart dari session
        $cart = Session::get('cart', []);

        // Temukan indeks item dalam keranjang
        $itemIndex = $this->findCartItemIndex($cart, $id);

        if ($itemIndex !== false) {
            // Jika item ada dalam keranjang, hapus
            $removedItem = array_splice($cart, $itemIndex, 1);

            // Perbarui stok berdasarkan jumlah item yang dihapus
            $this->updateStock($id, -$removedItem[0]['quantity']);
        }

        // Perbarui keranjang dalam sesi
        Session::put('cart', $cart);

        Session::flash('cart_updated', true);

        return redirect('/kasir')->with('success', 'Item berhasil dihapus dari keranjang.');

    }

    // Fungsi untuk mendapatkan stok barang
    public function getStock($id)
    {
        // Mencari data barang berdasarkan ID
        $barang = barang::find($id);

        // Jika barang tidak ditemukan, kembalikan respons error 404
        if (!$barang) {
            return response()->json(['error' => 'Produk tidak ditemukan.'], 404);
        }

        // Jika barang ditemukan, kembalikan respons dengan data stok barang
        return response()->json(['stok' => $barang->stok]);
    }

    // Fungsi untuk mengurangi jumlah barang dalam keranjang
    public function reduceQuantity($id)
    {
        //mengambil cart dari session
        $cart = Session::get('cart', []);

        // Temukan indeks item dalam keranjang
        $itemIndex = $this->findCartItemIndex($cart, $id);

        if ($itemIndex !== false) {
            // Jika item ada dalam keranjang dan jumlahnya lebih dari 1, kurangi jumlahnya sebanyak 1
            if ($cart[$itemIndex]['quantity'] > 1) {
                $cart[$itemIndex]['quantity']--;

                // Perbarui stok berdasarkan jumlah yang dikurangi
                $this->updateStock($id, -1);
            } else {
                // Jika jumlahnya 1, hapus item dari keranjang
                $removedItem = array_splice($cart, $itemIndex, 1);

                // Perbarui stok berdasarkan jumlah item yang dihapus
                $this->updateStock($id, -$removedItem[0]['quantity']);
            }
        }

        // Perbarui keranjang dalam sesi
        Session::put('cart', $cart);

        Session::flash('cart_updated', true);

        return redirect('/kasir')->with('success', 'Jumlah berhasil dikurangi.');
    }

    // Fungsi untuk proses checkout
    public function checkout(Request $request)
    {
        // Ambil item dari keranjang
        $cart = Session::get('cart', []);

        // Hitung total harga
        $totalPrice = 0;
        foreach ($cart as $barang_cart) {
            $subtotal = $barang_cart['harga'] * $barang_cart['quantity'];
            $totalPrice += $subtotal;
        }

        // Dapatkan pengguna yang sudah login (kasir)
        $nama_kasir = Auth::user()->name;

        // Dapatkan input pengguna untuk 'dibayar'
        $bayar = $request->input('bayar');

        // Simpan nilai 'bayar' dalam sesi
        Session::put('bayar', $bayar);

        // Generate data struk
        $struk = Struk::create([
            'nama_kasir' => $nama_kasir,
            'items' => $cart,
            'bayar' => $bayar,
            'total_harga' => $totalPrice,
        ]);

        // Bersihkan keranjang setelah checkout
        Session::forget('cart');

        $strukPrint = Struk::where('nama_kasir', $nama_kasir)->latest('id')->limit(1)->get(); // record terbaru

        // Kembalikan view dengan data struk
        return view('component-kasir.right-br', ['strukItems' => $struk, 'struk' => $strukPrint, 'kasir' => $nama_kasir, 'bayar' => $bayar]);
    }

    // Fungsi untuk menghasilkan PDF
    public function generatePDF()
    {
        // Konten HTML Anda
        $html = view('component-kasir.right-br')->render();

        // Buat instance mPDF
        $mpdf = new Mpdf();

        // Tambahkan pengaturan konfigurasi jika diperlukan
        // Misalnya, atur font
        $mpdf->SetDefaultFont('Arial');

        // Muat HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Output PDF
        $mpdf->Output();
    }

}
