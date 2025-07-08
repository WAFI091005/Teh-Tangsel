<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
public function toggle(Product $product)
{
    $user = auth()->user();
    $existing = $user->favorites()->where('product_id', $product->id)->first();

    if ($existing) {
        $existing->delete();
        return response()->json(['favorited' => false]);
    } else {
        $user->favorites()->create(['product_id' => $product->id]);
        return response()->json(['favorited' => true]);
    }
}



    public function index()
    {
        $favorites = auth()->user()->favorites()->with('product')->get();
        return view('favorites', compact('favorites'));
    }
}
