<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detail Produk - Teh Tangsel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="//unpkg.com/alpinejs" defer></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; background-color: #fff9f2; }
    .product-image:hover { transform: scale(1.02); transition: all 0.3s ease; }
    .add-to-cart-btn { position: relative; overflow: hidden; }
    .add-to-cart-btn::after {
      content: ''; position: absolute; top: -50%; right: -50%; bottom: -50%; left: -50%;
      background: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 50%);
      transform: rotateZ(60deg) translate(-5em, 7.5em);
    }
    .add-to-cart-btn:hover::after { animation: shine 1.5s infinite; }
    @keyframes shine { 100% { transform: rotateZ(60deg) translate(1em, -9em); } }
    .rating-stars { color: #ffc107; }
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'tehtangsel': {
              '50': '#fff7ed',
              '100': '#ffedd5',
              '200': '#fed7aa',
              '300': '#fdba74',
              '400': '#fb923c',
              '500': '#f97316',
              '600': '#ea580c',
              '700': '#c2410c',
              '800': '#9a3412',
              '900': '#7c2d12',
            }
          }
        }
      }
    }
  </script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-orange-50 min-h-screen">

  @include('components.navbar')

  <main class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
      <div class="flex flex-col lg:flex-row bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="lg:w-2/5 relative">
          <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="product-image w-full h-full object-cover"/>

          <div class="absolute top-3 left-3 bg-tehtangsel-600 text-white text-xs font-bold px-2 py-1 rounded-full">
            <i class="fas fa-bolt mr-1"></i> POPULAR
          </div>

          @auth
          @if (auth()->user()->role !== 'admin')
          <div 
            class="absolute top-3 right-3 bg-white rounded-full p-3 shadow-md cursor-pointer transition hover:scale-110"
            x-data="{
              favorited: {{ auth()->user()->isFavorite($product->id) ? 'true' : 'false' }},
              toggleFavorite() {
                fetch('{{ route('favorite.toggle', $product->id) }}', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                  },
                  body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                  this.favorited = data.favorited;
                });
              }
            }"
            @click="toggleFavorite"
          >
            <template x-if="favorited">
              <i class="fas fa-heart text-xl text-red-500 transition-all duration-300"></i>
            </template>
            <template x-if="!favorited">
              <i class="far fa-heart text-xl text-gray-400 transition-all duration-300"></i>
            </template>
          </div>
          @endif
          @endauth
        </div>

        <div class="lg:w-3/5 p-6">
          <div class="flex justify-between items-start">
            <div>
              <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">{{ $product->name ?? 'Nama Produk' }}</h1>
              <div class="flex items-center mb-2">
                <div class="rating-stars">
                  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
              </div>
            </div>
            <div class="text-2xl font-bold text-tehtangsel-600">
              Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
          </div>

          <p class="text-gray-600 my-4">{{ $product->description }}</p>

          @if (auth()->check() && auth()->user()->role === 'admin')
          <div class="flex gap-2 mt-4">
            <a href="{{ route('produk.edit', $product->id) }}"
               class="bg-blue-100 text-blue-600 p-3 rounded-full hover:bg-blue-200 transition-all duration-300 hover:scale-110 transform"
               title="Edit Produk">
              <i class="fas fa-edit text-lg"></i>
            </a>

            <form action="{{ route('produk.destroy', $product->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="bg-red-100 text-red-600 p-3 rounded-full hover:bg-red-200 transition-all duration-300 hover:scale-110 transform"
                      title="Hapus Produk">
                <i class="fas fa-trash-alt text-lg"></i>
              </button>
            </form>
          </div>
          @endif

          @auth
          @if (auth()->user()->role !== 'admin')
          <form class="space-y-4 mt-6" action="{{ route('cart.store', $product->id) }}" method="POST">
            @csrf
            <div>
              <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah:</label>
              <div class="flex">
                <button type="button" id="decrease" class="bg-gray-200 text-gray-600 px-3 py-2 rounded-l-md"><i class="fas fa-minus"></i></button>
                <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-16 text-center border-t border-b border-gray-300 outline-none">
                <button type="button" id="increase" class="bg-gray-200 text-gray-600 px-3 py-2 rounded-r-md"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <button type="submit" class="add-to-cart-btn w-full bg-tehtangsel-600 hover:bg-tehtangsel-700 text-white py-2 px-4 rounded-lg flex items-center justify-center gap-2">
                <i class="fas fa-shopping-cart"></i><span>Tambah Keranjang</span>
              </button>
            </div>
          </form>
          @endif
          @endauth
        </div>
      </div>
    </div>
  </main>

  <script>
    const decreaseBtn = document.getElementById("decrease");
    const increaseBtn = document.getElementById("increase");
    const qtyInput = document.getElementById("quantity");

    if (decreaseBtn && increaseBtn && qtyInput) {
      decreaseBtn.addEventListener("click", () => {
        if (parseInt(qtyInput.value) > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
      });
      increaseBtn.addEventListener("click", () => {
        qtyInput.value = parseInt(qtyInput.value) + 1;
      });
    }
  </script>

</body>
</html>
