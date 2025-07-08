<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Teh Tangsel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF5F1F',
                        'primary-light': '#FFF5F0',
                        'primary-dark': '#D74A00',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-primary-light min-h-screen text-gray-800">

    @include('components.navbar')

    <main class="max-w-6xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)
            @php $total = 0; @endphp
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Daftar Item -->
                <div class="md:col-span-2 space-y-4">
                    @foreach(session('cart') as $id => $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                        <div class="bg-white rounded-xl shadow p-4 flex flex-col sm:flex-row gap-4">
                            <div class="w-full sm:w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="object-cover w-full h-full">
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-base font-semibold">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex items-center border rounded-lg overflow-hidden text-sm">
                                        <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </form>
                                        <span class="px-4">{{ $item['quantity'] }}</span>
                                        <form action="{{ route('cart.increase', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="font-semibold text-primary text-sm">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="self-start">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Ringkasan -->
                <div class="bg-white rounded-xl shadow p-6 sticky top-24 h-fit">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Belanja</h3>
                    <div class="flex justify-between text-sm mb-2">
                        <span>Total Item</span>
                        <span>{{ count(session('cart')) }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg text-primary border-t pt-4 mt-4">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block w-full mt-6 text-center bg-primary hover:bg-primary-dark text-white py-3 rounded-lg font-medium text-sm">
                        Lanjut ke Checkout
                    </a>
                    <a href="{{ route('menu.index') }}" class="mt-3 text-primary hover:underline text-sm block text-center">
                        + Tambah Produk Lain
                    </a>
                </div>
            </div>
        @else
            <!-- Kosong -->
            <div class="bg-white shadow rounded-xl p-8 text-center max-w-md mx-auto">
                <div class="text-4xl text-primary mb-4">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h2 class="text-lg font-semibold">Keranjang Kosong</h2>
                <p class="text-sm text-gray-500 mt-2 mb-4">Ayo tambahkan produk favoritmu!</p>
                <a href="{{ route('menu.index') }}" class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg text-sm">
                    Mulai Belanja <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @endif
    </main>
</body>
</html>
