<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\Auth;

class PaymentAccountController extends Controller
{
    public function create(Request $request)
    {
        $method = $request->query('method');
        return view('payment-account', compact('method'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'method' => 'required',
            'account_number' => 'required'
        ]);

        PaymentAccount::updateOrCreate(
            ['user_id' => Auth::id(), 'method' => $request->method],
            ['account_number' => $request->account_number]
        );

        return redirect()->route('checkout.index')->with('success', '...');

    }
}
