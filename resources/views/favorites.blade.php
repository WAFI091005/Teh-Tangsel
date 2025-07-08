<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Favorit Saya - Teh Tangsel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fffaf3;
    }
  </style>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-orange-50 min-h-screen">

@include('components.navbar')

<main class="container mx-auto px-4 py-8">
  <h2 class="text-2xl font-bold mb-6 text-orange-800">❤️ Favorit Saya</h2>

  @if ($favorites->isEmpty())
    <p class="text-gray-600">Belum ada produk favorit.</p>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($favorites as $fav)
        @php $product = $fav->product; @endphp
        <div 
          x-data="{
            visible: true,
            async unlike() {
              const response = await fetch('{{ route('favorite.toggle', $product->id) }}', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                },
                body: JSON.stringify({})
              });
              if (response.ok) {
                this.visible = false;
              }
            }
          }"
          x-show="visible"
          class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden"
        >
          <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
            <p class="text-orange-600 font-bold mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            
            <div class="mt-3 flex justify-between items-center flex-wrap gap-2">
              <div class="flex items-center gap-2">
                <a href="{{ route('menu.show', $product->id) }}" class="text-sm text-white bg-orange-600 hover:bg-orange-700 px-3 py-1 rounded">
                  Lihat Detail
                </a>

                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="text-sm text-white bg-orange-600 hover:bg-orange-700 px-3 py-1 rounded">
                    Beli Lagi
                  </button>
                </form>
              </div>

              <button 
                @click="unlike"
                class="text-sm text-red-500 hover:text-red-600 px-3 py-1 rounded"
              >
                <i class="fas fa-heart"></i> Hapus
              </button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</main>

</body>
</html>
