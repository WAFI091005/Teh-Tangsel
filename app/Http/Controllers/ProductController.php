<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Menampilkan semua produk di halaman /menu
    public function index()
    {
        $products = Product::all();
        return view('menu', compact('products'));
    }

    // Menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // Menyimpan data produk ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'kategori' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $validatedData['image'] = $filename;
        }

        Product::create($validatedData);

        return redirect()->route('menu.index');

    }

    public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Hapus file gambar jika ada
    if ($product->image && file_exists(public_path('images/' . $product->image))) {
        unlink(public_path('images/' . $product->image));
    }

    $product->delete();

    return redirect()->route('menu.index');
}

  public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }

    // Memperbarui data produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'kategori' => 'required|string'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->kategori = $request->kategori;

        // Tambahkan bagian ini jika ingin update gambar juga
        // if ($request->hasFile('image')) {
        //     $filename = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $filename);
        //     $product->image = $filename;
        // }

        $product->save();

        return redirect()->route('menu.index');
    }

}
