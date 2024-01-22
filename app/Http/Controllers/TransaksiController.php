<?php
namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
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

        return false; // Return false if the item is not found in the cart
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform the search query on your model
        $barang = barang::where('nama_barang', 'like', '%' . $query . '%')
            ->orWhere('stok', 'like', '%' . $query . '%')
            ->orWhere('harga_barang', 'like', '%' . $query . '%')
            ->get();

        // Check if any records are found
        if ($barang->isEmpty()) {
            $message_missing = 'Barang tidak ditemukan.';
        } else {
            $message_missing = null;
        }

        return view('kasir-page.kasir', compact('barang', 'message_missing'));
    }

    public function addToCart(Request $request, $id)
    {
        $barang = barang::find($id);

        if (!$barang) {
            return redirect('kasir-page.kasir')->with('error', 'Product not found.');
        }

        $cart = Session::get('cart', []);

        $existingItemIndex = $this->findCartItemIndex($cart, $barang->id);

        if ($existingItemIndex !== false) {
            // If the item exists in the cart, increment the quantity
            $cart[$existingItemIndex]['quantity']++;
        } else {
            // If the item is not in the cart, add it
            $cart[] = [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'quantity' => 1,
                'harga' => $barang->harga_barang,
            ];


        }

        Session::put('cart', $cart);

        return redirect('/kasir')->with('success', 'Item added to cart successfully.');


    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        // Find the index of the item in the cart
        $itemIndex = $this->findCartItemIndex($cart, $id);

        if ($itemIndex !== false) {
            // If the item exists in the cart, remove it
            $removedItem = array_splice($cart, $itemIndex, 1);

            // Update stock based on the removed item's quantity
            // $this->updateStock($id, -$removedItem[0]['quantity']);
        }

        // Update the cart in the session
        Session::put('cart', $cart);


        Session::flash('cart_updated', true);

        return redirect('/kasir')->with('success', 'Item removed from cart successfully.');

    }

}
