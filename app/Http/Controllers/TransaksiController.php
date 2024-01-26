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
            // return redirect('/kasir')->with('error', 'Product not found.');
        }

        $cart = Session::get('cart', []);

        $existingItemIndex = $this->findCartItemIndex($cart, $barang->id);

        if ($existingItemIndex !== false) {
            // If the item exists in the cart, increment the quantity
            $cart[$existingItemIndex]['quantity']++;

            // Update stock only for new items added to the cart
            $this->updateStock($barang->id, 1);

        } else {
            // If the item is not in the cart, add it
            $cart[] = [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'quantity' => 1,
                'harga' => $barang->harga_barang,
            ];

            // Update stock only for new items added to the cart
            $this->updateStock($barang->id, 1);
        }

        Session::put('cart', $cart);

        return redirect('/kasir')->with('success', 'Item added to cart successfully.');
    }

    private function updateStock($id, $quantity)
    {
        // Call the stored procedure to update stock
        DB::select("CALL UpdateStock(?, ?)", [$id, $quantity]);
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
            $this->updateStock($id, -$removedItem[0]['quantity']);
        }

        // Update the cart in the session
        Session::put('cart', $cart);


        Session::flash('cart_updated', true);

        return redirect('/kasir')->with('success', 'Item removed from cart successfully.');

    }

    public function getStock($id)
    {
        $barang = barang::find($id);

        if (!$barang) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        return response()->json(['stok' => $barang->stok]);
    }


    public function reduceQuantity($id)
    {
        $cart = Session::get('cart', []);

        // Find the index of the item in the cart
        $itemIndex = $this->findCartItemIndex($cart, $id);

        if ($itemIndex !== false) {
            // If the item exists in the cart and its quantity is greater than 1, reduce the quantity by 1
            if ($cart[$itemIndex]['quantity'] > 1) {
                $cart[$itemIndex]['quantity']--;

                // Updates stock based on the reduced quantity
                $this->updateStock($id, -1);
            } else {
                // If the quantity is 1, remove the item from the cart
                $removedItem = array_splice($cart, $itemIndex, 1);

                // Update stock based on the removed item's quantity
                $this->updateStock($id, -$removedItem[0]['quantity']);
            }
        }

        // Update the cart in the session
        Session::put('cart', $cart);

        Session::flash('cart_updated', true);

        return redirect('/kasir')->with('success', 'Quantity reduced successfully.');
    }

    public function checkout(Request $request)
    {
        // Retrieve items from the cart
        $cart = Session::get('cart', []);

        // Calculate the total price
        $totalPrice = 0;
        foreach ($cart as $barang_cart) {
            $subtotal = $barang_cart['harga'] * $barang_cart['quantity'];
            $totalPrice += $subtotal;
        }

        // Get the logged-in user (cashier)
        $nama_kasir = Auth::user()->name;

        // Get user input for 'dibayar'
        $bayar = $request->input('bayar');

        // Store 'bayar' value in session
        Session::put('bayar', $bayar);

        // Generate receipt data
        $struk = Struk::create([
            'nama_kasir' => $nama_kasir,
            'items' => $cart,
            'bayar' => $bayar,
            'total_harga' => $totalPrice,
            // Add other relevant information to the receipt
        ]);

        // Clear the cart after checkout
        Session::forget('cart');

        $strukPrint = Struk::where('nama_kasir', $nama_kasir)->latest('id')->limit(1)->get(); // the most recent record

        // Return a view with the receipt data
        return view('component-kasir.right-br', ['strukItems' => $struk, 'struk' => $strukPrint, 'kasir' => $nama_kasir, 'bayar' => $bayar]);
    }

    public function generatePDF()
    {
        // Your HTML content
        $html = view('component-kasir.right-br')->render();

        // Create mPDF instance
        $mpdf = new Mpdf();

        // Add your configuration settings if needed
        // For example, set font
        $mpdf->SetDefaultFont('Arial');

        // Load HTML into mPDF
        $mpdf->WriteHTML($html);

        // Output PDF
        $mpdf->Output();
    }

}
