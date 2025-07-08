<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan - Teh Tangsel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .status-badge {
            animation: pulse 2s ease-in-out infinite;
        }
        
        .order-card {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .order-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #ff9a56 0%, #ff6b35 100%);
        }
        
        .status-processing {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .status-shipped {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .status-completed {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .slide-in {
            animation: slideIn 0.6s ease-out forwards;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .btn-modern {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }
        
        .btn-modern:hover::before {
            width: 100%;
            height: 100%;
        }
        
        .filter-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-purple-50">

@include('components.navbar')

<!-- Floating Background Elements -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-10 left-10 w-20 h-20 bg-orange-200 rounded-full opacity-20 floating-animation"></div>
    <div class="absolute top-1/3 right-20 w-16 h-16 bg-pink-200 rounded-full opacity-20 floating-animation" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-purple-200 rounded-full opacity-20 floating-animation" style="animation-delay: -4s;"></div>
</div>

<div class="relative z-10">
    <!-- Header Section -->
    <div class="gradient-bg text-white py-16 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-6">
                    <i class="ph ph-clipboard-text text-4xl"></i>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Daftar Pesanan Anda</h1>
                <p class="text-xl text-orange-100 max-w-2xl mx-auto">Kelola dan pantau semua pesanan Anda dengan mudah</p>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 -mt-8 pb-16">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-gradient-to-r from-green-400 to-green-600 text-white px-6 py-4 rounded-2xl mb-8 shadow-lg slide-in">
                <div class="flex items-center">
                    <i class="ph ph-check-circle text-2xl mr-3"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="filter-card rounded-2xl p-6 mb-8 slide-in">
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <div class="flex flex-wrap gap-2">
                    <button onclick="filterOrders('all')" class="filter-btn px-6 py-2 rounded-full transition-all duration-300 font-medium bg-orange-500 text-white">
                        Semua
                    </button>
                    <button onclick="filterOrders('Diproses')" class="filter-btn px-6 py-2 rounded-full transition-all duration-300 font-medium bg-white text-gray-700 hover:bg-blue-50">
                        Diproses
                    </button>
                    <button onclick="filterOrders('Dikirim')" class="filter-btn px-6 py-2 rounded-full transition-all duration-300 font-medium bg-white text-gray-700 hover:bg-pink-50">
                        Dikirim
                    </button>
                    <button onclick="filterOrders('Selesai')" class="filter-btn px-6 py-2 rounded-full transition-all duration-300 font-medium bg-white text-gray-700 hover:bg-green-50">
                        Selesai
                    </button>
                </div>
                {{-- <div class="relative">
                    <i class="ph ph-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchInput" placeholder="Cari pesanan..." class="pl-12 pr-4 py-3 rounded-full border-0 bg-white shadow-lg focus:ring-2 focus:ring-orange-500 focus:outline-none w-full lg:w-80" onkeyup="searchOrders()">
                </div> --}}
            </div>
        </div>

        <!-- Orders List -->
        <div class="space-y-6" id="ordersContainer">
            @forelse ($orders as $order)
                <div class="order-card glass-card rounded-3xl p-6 lg:p-8 shadow-xl slide-in order-item" 
                     data-status="{{ $order->status }}" 
                     data-search="{{ $order->id }} {{ $order->shipping_address }}"
                     style="animation-delay: {{ $loop->index * 0.1 }}s">
                    
                    <!-- Order Header -->
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                        <div class="flex items-center space-x-4 mb-4 lg:mb-0">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl text-white
                                @if($order->status === 'Selesai') status-completed
                                @elseif($order->status === 'Dikirim') status-shipped
                                @else status-processing @endif">
                                <i class="@if($order->status === 'Selesai') ph ph-check-circle
                                         @elseif($order->status === 'Dikirim') ph ph-truck
                                         @else ph ph-clock @endif"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Pesanan</h3>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <span class="status-badge px-4 py-2 rounded-full text-white text-sm font-medium shadow-lg
                                @if($order->status === 'Selesai') bg-gradient-to-r from-green-500 to-teal-500
                                @elseif($order->status === 'Dikirim') bg-gradient-to-r from-pink-500 to-red-500
                                @else bg-gradient-to-r from-blue-500 to-purple-500 @endif">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Order Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center text-white">
                                    <i class="ph ph-wallet text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Total Pembayaran</p>
                                    <p class="text-xl font-bold text-gray-800">Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center text-white">
                                    <i class="ph ph-credit-card text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Metode Pembayaran</p>
                                    <p class="text-lg font-bold text-gray-800">{{ strtoupper($order->payment_method) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-4 md:col-span-2 lg:col-span-1">
                            <div class="flex items-start space-x-3">
                                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center text-white">
                                    <i class="ph ph-map-pin text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Alamat Pengiriman</p>
                                    <p class="text-sm font-semibold text-gray-800 leading-relaxed">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        </div>

                        @if (auth()->user()->role === 'admin')
                            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-4 md:col-span-2 lg:col-span-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center text-white">
                                        <i class="ph ph-user text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Nama Pelanggan</p>
                                        <p class="text-lg font-bold text-gray-800">{{ $order->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                        @if (auth()->user()->role === 'admin' && $order->status === 'Diproses')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="flex-1 sm:flex-none">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-modern w-full bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition-all duration-300 flex items-center justify-center space-x-2">
                                    <i class="ph ph-truck text-xl"></i>
                                    <span>Tandai Dikirim</span>
                                </button>
                            </form>
                        @endif

                        @if (auth()->user()->role === 'user' && $order->status === 'Dikirim' && $order->user_id === auth()->id())
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="flex-1 sm:flex-none">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-modern w-full bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition-all duration-300 flex items-center justify-center space-x-2">
                                    <i class="ph ph-check-circle text-xl"></i>
                                    <span>Tandai Selesai</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-orange-100 to-orange-200 rounded-full flex items-center justify-center">
                        <i class="ph ph-package text-6xl text-orange-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Pesanan</h3>
                    <p class="text-gray-600 mb-8">Anda belum memiliki pesanan. Mulai berbelanja sekarang!</p>
                    
                    <a href="{{ route('menu.index') }}">
                        <button class="btn-modern bg-gradient-to-r from-orange-500 to-pink-500 hover:from-orange-600 hover:to-pink-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition-all duration-300">
                            Mulai Berbelanja
                        </button>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Filter functionality
    function filterOrders(status) {
        const orders = document.querySelectorAll('.order-item');
        const buttons = document.querySelectorAll('.filter-btn');
        
        // Update active button
        buttons.forEach(btn => {
            btn.classList.remove('bg-orange-500', 'text-white', 'bg-blue-500', 'bg-pink-500', 'bg-green-500');
            btn.classList.add('bg-white', 'text-gray-700');
        });
        
        event.target.classList.remove('bg-white', 'text-gray-700');
        if (status === 'all') {
            event.target.classList.add('bg-orange-500', 'text-white');
        } else if (status === 'Diproses') {
            event.target.classList.add('bg-blue-500', 'text-white');
        } else if (status === 'Dikirim') {
            event.target.classList.add('bg-pink-500', 'text-white');
        } else if (status === 'Selesai') {
            event.target.classList.add('bg-green-500', 'text-white');
        }
        
        // Filter orders
        orders.forEach(order => {
            if (status === 'all' || order.dataset.status === status) {
                order.style.display = 'block';
                setTimeout(() => {
                    order.style.opacity = '1';
                    order.style.transform = 'translateY(0)';
                }, 50);
            } else {
                order.style.opacity = '0';
                order.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    order.style.display = 'none';
                }, 300);
            }
        });
    }
    
    // Search functionality
    function searchOrders() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const orders = document.querySelectorAll('.order-item');
        
        orders.forEach(order => {
            const searchData = order.dataset.search.toLowerCase();
            if (searchData.includes(searchTerm)) {
                order.style.display = 'block';
                setTimeout(() => {
                    order.style.opacity = '1';
                    order.style.transform = 'translateY(0)';
                }, 50);
            } else {
                order.style.opacity = '0';
                order.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    order.style.display = 'none';
                }, 300);
            }
        });
    }

    // Add scroll animations
    window.addEventListener('scroll', () => {
        const cards = document.querySelectorAll('.order-card');
        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            const cardBottom = card.getBoundingClientRect().bottom;
            
            if (cardTop < window.innerHeight && cardBottom > 0) {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }
        });
    });
</script>

</body>
</html>