<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentAccount; // tambahkan ini
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'shipping_address' => 'required|string',
        ]);

        $paymentMethod = $request->payment_method;

        // ❗ Cek akun pembayaran jika bukan COD
        if ($paymentMethod !== 'cod') {
            $hasAccount = PaymentAccount::where('user_id', auth()->id())
                ->where('method', $paymentMethod)
                ->exists();

            if (! $hasAccount) {
                return redirect()->route('payment-account.create', ['method' => $paymentMethod])
                    ->with('error', 'Silakan isi akun pembayaran terlebih dahulu.');
            }
        }

        // Lanjut proses order
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $total = session('cart_total', 0);

        $order = new Order();
        $order->user_id = auth()->id();
        $order->payment_method = $paymentMethod;
        $order->total = $total;
        $order->shipping_address = $request->shipping_address;
        $order->status = 'Diproses';
        $order->save();

        foreach ($cart as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');
        session()->forget('cart_total');

        return redirect()->route('checkout.success')->with('success', 'Pembayaran berhasil!');
    }
}
