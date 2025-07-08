<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('status', [
            'name' => session('order_name'),
            'phone' => session('order_phone'),
            'note' => session('order_note')
        ]);
    }
}

