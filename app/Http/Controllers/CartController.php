<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $request->quantity;
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'image' => $product->image,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');

}
public function index()
{
    return view('cart');
}

public function remove($id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
}


public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    Cart::create([
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'status' => 'pending', // atau sesuai kebutuhan
    ]);

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}

public function decrease($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } else {
            unset($cart[$id]); // jika quantity = 1, hapus item
        }
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil dikurangi.');
}
public function increase($id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
    }
    return redirect()->route('cart.index')->with('success', 'Jumlah produk ditambah.');
}

public function checkout()
{
    // nanti kamu bisa kembangkan lebih lanjut
    return view('checkout');
}



}
