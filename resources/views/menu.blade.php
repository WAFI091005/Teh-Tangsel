<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modern Menu - Teh Tangsel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        * { font-family: "Poppins", sans-serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f5f5f5; }
        ::-webkit-scrollbar-thumb { background: #fb923c; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }

        /* Original gradient animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .gradient-text {
            background-image: linear-gradient(45deg, #f97316, #f59e0b, #f97316, #f59e0b);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradient 3s ease infinite;
        }

        /* New Animations */

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        /* Bounce Animation */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .bounce-animation {
            animation: bounce 2s infinite;
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        /* Shake Animation */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .shake-animation:hover {
            animation: shake 0.5s;
        }

        /* Slide Animations */
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .slide-in-left {
            animation: slideInLeft 1s ease-out;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .slide-in-right {
            animation: slideInRight 1s ease-out;
        }

        /* Fade in up */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Stagger animation for cards */
        .product-card:nth-child(1) { animation-delay: 0.1s; }
        .product-card:nth-child(2) { animation-delay: 0.2s; }
        .product-card:nth-child(3) { animation-delay: 0.3s; }
        .product-card:nth-child(4) { animation-delay: 0.4s; }
        .product-card:nth-child(5) { animation-delay: 0.5s; }
        .product-card:nth-child(6) { animation-delay: 0.6s; }
        .product-card:nth-child(7) { animation-delay: 0.7s; }
        .product-card:nth-child(8) { animation-delay: 0.8s; }

        /* Enhanced product card hover animations */
        .product-card {
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .product-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(249, 115, 22, 0.15);
        }

        .product-card:hover .product-image {
            transform: scale(1.08) rotate(1deg);
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Rotating border animation */
        @keyframes rotateBorder {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .rotating-border::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #f97316, #f59e0b, #f97316);
            border-radius: 50%;
            animation: rotateBorder 4s linear infinite;
            z-index: -1;
        }

        /* Glowing effect */
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.4); }
            50% { box-shadow: 0 0 40px rgba(249, 115, 22, 0.8); }
        }

        .glow-animation {
            animation: glow 3s ease-in-out infinite;
        }

        /* Background floating elements */
        .floating-element {
            position: absolute;
            opacity: 0.08;
            animation: float 12s ease-in-out infinite;
            z-index: 1;
        }

        .floating-element:nth-child(1) { top: 15%; left: 8%; animation-delay: 0s; }
        .floating-element:nth-child(2) { top: 50%; right: 10%; animation-delay: 4s; }
        .floating-element:nth-child(3) { bottom: 25%; left: 15%; animation-delay: 8s; }
        .floating-element:nth-child(4) { top: 75%; right: 25%; animation-delay: 2s; }

        /* Cart bounce effect */
        @keyframes cartBounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .cart-bounce {
            animation: cartBounce 0.6s ease-in-out;
        }

        /* Badge animations */
        .badge-pulse {
            animation: pulse 2s infinite;
        }

        /* Button hover effects */
        .btn-hover-effect {
            position: relative;
            overflow: hidden;
        }

        .btn-hover-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-hover-effect:hover::before {
            left: 100%;
        }

        /* Staggered fade in for initial load */
        .stagger-fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* Background particles */
        @keyframes particle-float {
            0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); }
            33% { transform: translateY(-30px) translateX(20px) rotate(120deg); }
            66% { transform: translateY(20px) translateX(-20px) rotate(240deg); }
        }

        .particle {
            position: absolute;
            opacity: 0.05;
            animation: particle-float 15s ease-in-out infinite;
        }

        .particle:nth-child(1) { top: 10%; left: 20%; animation-delay: 0s; }
        .particle:nth-child(2) { top: 30%; right: 20%; animation-delay: 3s; }
        .particle:nth-child(3) { bottom: 40%; left: 10%; animation-delay: 6s; }
        .particle:nth-child(4) { top: 60%; right: 30%; animation-delay: 9s; }
        .particle:nth-child(5) { bottom: 20%; right: 10%; animation-delay: 12s; }

        /* Success message slide animation */
        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-slide {
            animation: slideInDown 0.5s ease-out;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gradient-to-b from-orange-50 via-orange-100 to-amber-100 min-h-screen overflow-x-hidden">

    <!-- Background Particles -->
    <div class="particle"><i class="fas fa-leaf text-4xl text-green-400"></i></div>
    <div class="particle"><i class="fas fa-coffee text-3xl text-orange-400"></i></div>
    <div class="particle"><i class="fas fa-heart text-2xl text-red-400"></i></div>
    <div class="particle"><i class="fas fa-star text-3xl text-yellow-400"></i></div>
    <div class="particle"><i class="fas fa-sun text-4xl text-amber-400"></i></div>

    <!-- Floating Cart -->
    @auth
        @if(Auth::user()->role === 'user')
            <div class="fixed bottom-4 right-4 z-50 pulse-animation">
                <a href="{{ route('cart.index') }}" class="bg-gradient-to-r from-orange-500 to-amber-500 text-white p-4 rounded-full shadow-2xl hover:shadow-orange-300 transition-all duration-300 hover:scale-110 relative block glow-animation shake-animation">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold bounce-animation">
                        {{ $cartCount }}
                    </span>
                </a>
            </div>
        @endif
    @endauth

    @include('components.navbar')

    @if(session('success'))
        <div class="container mx-auto px-4 pt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 success-slide" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="hidden md:block relative py-12 md:py-16 lg:py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-100/70 to-transparent z-10"></div>
            <div class="absolute top-0 right-0 w-full h-full bg-cover opacity-10" style="background-image: url('https://images.unsplash.com/photo-1600271886742-f049cd451bba?ixlib=rb-4.0.3&auto=format&fit=crop&w=3387&q=80')"></div>
        </div>
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center relative z-20">
            <div class="md:w-1/2 mb-10 md:mb-0 slide-in-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Nikmati<br /><span class="gradient-text">Segarnya Teh</span><br />Pilihan Anda
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-lg fade-in-up">
                    Temukan berbagai varian teh berkualitas tinggi dengan cita rasa yang menyegarkan untuk menemani hari-harimu.
                </p>
                <div class="flex gap-4 fade-in-up">
                    <a href="#product" class="bg-gradient-to-r from-orange-500 to-amber-500 text-white px-6 py-3 rounded-full font-medium hover:from-orange-600 hover:to-amber-600 transition-all duration-300 shadow-lg hover:shadow-orange-300 hover:scale-105 transform btn-hover-effect">
                        Order Sekarang
                    </a>
                    <a href="#product" class="border border-orange-500 text-orange-500 px-6 py-3 rounded-full font-medium hover:bg-orange-50 transition-all duration-300 hover:scale-105 transform shake-animation">
                        Lihat Menu
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center slide-in-right">
                <div class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 float-animation">
                    <div class="absolute w-full h-full rounded-full bg-gradient-to-r from-orange-400 to-amber-300 opacity-20 blur-xl z-0 pulse-animation"></div>
                    <img src="{{ asset('images/logo.png') }}" alt="Teh Segar" class="relative w-full h-full object-cover rounded-full border-8 border-white shadow-2xl z-10 hover:scale-105 transition-transform duration-500 glow-animation" />
                </div>
            </div>
        </div>
    </section>

    <!-- Product Section -->
    <section class="container mx-auto px-4 py-12 relative" id="product">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 fade-in-up">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Menu <span class="gradient-text">Kami</span></h2>
                <p class="text-gray-600 hidden md:block">Pilih dan nikmati minuman favorit Anda</p>
            </div>
        </div>

       <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div class="product-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden stagger-fade-in">
                    <div class="relative overflow-hidden h-64">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="product-image w-full h-full object-cover transition-transform duration-500" />
                        {{-- @if ($product->kategori == 'best-seller')
                            <div class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold badge-pulse">
                                Best Seller
                            </div>
                        @endif --}}
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $product->name }}</h3>
                            <span class="text-lg font-bold text-orange-600 pulse-animation">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>

                        <div class="flex justify-between items-center mt-4">
                            @if (auth()->user()->role !== 'admin')
                                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-amber-500 text-white p-3 rounded-full hover:from-orange-600 hover:to-amber-600 transition-all duration-300 hover:scale-110 transform btn-hover-effect shake-animation cart-btn" title="Tambah ke Keranjang">
                                        <i class="fas fa-shopping-cart text-lg"></i>
                                    </button>
                                </form>
                            @endif

                            <div class="flex gap-2">
                                <a href="{{ route('menu.show', $product->id) }}"
                                class="bg-gray-200 text-gray-800 p-3 rounded-full hover:bg-gray-300 transition-all duration-300 hover:scale-110 transform"
                                title="Lihat Detail">
                                    <i class="fas fa-info-circle text-lg"></i>
                                </a>

                                @if (auth()->user()->role === 'admin')
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-md shadow-inner py-6 mt-20 fade-in-up">
        <div class="container mx-auto px-4 text-center text-gray-700">
            <div class="flex justify-center items-center gap-4 mb-4">
                <i class="fas fa-leaf text-orange-500 pulse-animation"></i>
                <span>&copy; 2025 Teh Tangsel. All rights reserved.</span>
                <i class="fas fa-heart text-red-500 pulse-animation"></i>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add click animation to cart buttons
            const cartButtons = document.querySelectorAll('.cart-btn');
            cartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Add cart bounce effect
                    this.classList.add('cart-bounce');
                    
                    // Create floating effect
                    const rect = this.getBoundingClientRect();
                    const floatingIcon = document.createElement('div');
                    floatingIcon.innerHTML = '<i class="fas fa-shopping-cart"></i>';
                    floatingIcon.style.cssText = `
                        position: fixed;
                        left: ${rect.left + rect.width/2}px;
                        top: ${rect.top}px;
                        color: #f97316;
                        font-size: 20px;
                        pointer-events: none;
                        z-index: 9999;
                        transition: all 0.8s ease-out;
                    `;
                    document.body.appendChild(floatingIcon);
                    
                    // Animate floating icon to cart
                    setTimeout(() => {
                        floatingIcon.style.transform = 'translateY(-100px) scale(0.5)';
                        floatingIcon.style.opacity = '0';
                    }, 50);
                    
                    // Remove floating icon
                    setTimeout(() => {
                        floatingIcon.remove();
                    }, 850);
                    
                    // Remove bounce class
                    setTimeout(() => {
                        this.classList.remove('cart-bounce');
                    }, 600);
                });
            });

            // Stagger animation for product cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, observerOptions);

            // Observe all stagger elements
            const staggerElements = document.querySelectorAll('.stagger-fade-in');
            staggerElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease-out';
                observer.observe(el);
            });

            // Add hover sound effect simulation (visual feedback)
            const hoverElements = document.querySelectorAll('.product-card, button, a');
            hoverElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.filter = 'brightness(1.05)';
                });
                element.addEventListener('mouseleave', function() {
                    this.style.filter = 'brightness(1)';
                });
            });

            // Success message auto-hide with animation
            const successAlert = document.querySelector('.success-slide');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transform = 'translateY(-100px)';
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>