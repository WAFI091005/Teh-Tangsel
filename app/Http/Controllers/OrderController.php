<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        session(['cart_total' => $total]);

        return view('checkout', compact('cart', 'total'));
    }
    public function list()
{
    $user = auth()->user();

    $orders = $user->role === 'admin'
        ? Order::with('user')->latest()->get()
        : $user->orders()->latest()->get();

    return view('orders', compact('orders'));
}

public function updateStatus(Request $request, Order $order)
{
    $user = auth()->user();

    if ($user->role === 'admin' && $order->status === 'Diproses') {
        $order->status = 'Dikirim';
    } elseif ($user->role === 'user' && $order->status === 'Dikirim' && $order->user_id === $user->id) {
        $order->status = 'Selesai';
    } else {
        return back()->with('error', 'Akses tidak diizinkan.');
    }

    $order->save();
    return back()->with('success', 'Status berhasil diperbarui.');
}

public function aktivitas()
{
    $produkTerjual = OrderItem::with('product', 'order.user')->get()
        ->groupBy('product_id');

    $dataChart = [];

    foreach ($produkTerjual as $productId => $items) {
        $productName = $items->first()->product->name;
        $jumlahTerjual = $items->sum('quantity'); // ✅ Ini yang penting

        $dataChart[] = [
            'name' => $productName,
            'count' => $jumlahTerjual
        ];
    }

    return view('aktivitas', [
        'produkTerjual' => $produkTerjual,
        'dataChart' => $dataChart
    ]);
}

}
