<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk - Teh Tangsel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 p-8 font-sans">
  <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4 text-orange-800">Edit Produk</h1>

    <form method="POST" action="{{ route('produk.update', $product->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block text-gray-700">Nama Produk</label>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full px-4 py-2 border rounded" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Harga</label>
        <input type="number" name="price" value="{{ $product->price }}" class="w-full px-4 py-2 border rounded" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Deskripsi</label>
        <textarea name="description" class="w-full px-4 py-2 border rounded" required>{{ $product->description }}</textarea>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Kategori</label>
        <select name="kategori" class="w-full px-4 py-2 border rounded">
          <option value="best-seller" {{ $product->kategori === 'best-seller' ? 'selected' : '' }}>Best Seller</option>
          <option value="regular" {{ $product->kategori === 'regular' ? 'selected' : '' }}>Regular</option>
        </select>
      </div>

      <div class="flex justify-between">
        <a href="{{ route('menu.index') }}" class="text-orange-700 hover:underline">← Kembali</a>
        <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
