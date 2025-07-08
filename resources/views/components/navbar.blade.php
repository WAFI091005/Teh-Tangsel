<header x-data="{ open: false }" class="sticky top-0 z-40 bg-white/60 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-r from-orange-500 to-amber-500 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            <h1 class="text-2xl font-bold">
                <span class="gradient-text">Teh Tangsel</span>
            </h1>
        </div>

        <!-- Hamburger button -->
        <button @click="open = !open" class="md:hidden text-orange-600 focus:outline-none">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Desktop nav -->
        <nav class="hidden md:flex items-center space-x-8">
            <a href="{{ route('menu.index') }}" 
               class="font-medium transition-all duration-300 relative group
                      {{ request()->routeIs('menu.index') || request()->routeIs('menu.show') 
                         ? 'text-orange-600' 
                         : 'text-gray-600 hover:text-orange-600' }}">
                Home
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                           {{ request()->routeIs('menu.index') || request()->routeIs('menu.show') ? 'w-full' : '' }}"></span>
            </a>

            @auth
                @if (Auth::user()->role === 'user')
                    <a href="{{ route('menu.index') }}#product" 
                       class="font-medium transition-all duration-300 relative group
                              {{ request()->routeIs('menu.index') && request()->has('scroll') 
                                 ? 'text-orange-600' 
                                 : 'text-gray-600 hover:text-orange-600' }}">
                        Menu
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="{{ route('favorites.index') }}" 
                       class="font-medium transition-all duration-300 relative group
                              {{ request()->routeIs('favorites.index') 
                                 ? 'text-orange-600' 
                                 : 'text-gray-600 hover:text-orange-600' }}">
                        Favorit Saya
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                                   {{ request()->routeIs('favorites.index') ? 'w-full' : '' }}"></span>
                    </a>

                @elseif (Auth::user()->role === 'admin')
                    <a href="{{ route('pengguna.index') }}" 
                       class="font-medium transition-all duration-300 relative group
                              {{ request()->routeIs('pengguna.*') 
                                 ? 'text-orange-600' 
                                 : 'text-gray-600 hover:text-orange-600' }}">
                        Pengguna
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                                   {{ request()->routeIs('pengguna.*') ? 'w-full' : '' }}"></span>
                    </a>
                    
                    <a href="{{ route('produk.create') }}" 
                       class="font-medium transition-all duration-300 relative group
                              {{ request()->routeIs('produk.create') 
                                 ? 'text-orange-600' 
                                 : 'text-gray-600 hover:text-orange-600' }}">
                        + Produk
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                                   {{ request()->routeIs('produk.create') ? 'w-full' : '' }}"></span>
                    </a>
                    
                    <a href="{{ route('aktivitas') }}" 
                       class="font-medium transition-all duration-300 relative group
                              {{ request()->routeIs('aktivitas') 
                                 ? 'text-orange-600' 
                                 : 'text-gray-600 hover:text-orange-600' }}">
                        Aktivitas
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                                   {{ request()->routeIs('aktivitas') ? 'w-full' : '' }}"></span>
                    </a>
                @endif
            @endauth

            <a href="{{ route('orders.list') }}" 
               class="font-medium transition-all duration-300 relative group
                      {{ request()->routeIs('orders.*') 
                         ? 'text-orange-600' 
                         : 'text-gray-600 hover:text-orange-600' }}">
                Pesanan
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                           {{ request()->routeIs('orders.*') ? 'w-full' : '' }}"></span>
            </a>

            <a href="{{ route('profil') }}" 
               class="font-medium transition-all duration-300 relative group
                      {{ request()->routeIs('profil') 
                         ? 'text-orange-600' 
                         : 'text-gray-600 hover:text-orange-600' }}">
                Profil
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                           {{ request()->routeIs('profil') ? 'w-full' : '' }}"></span>
            </a>
        </nav>
    </div>

    <!-- Mobile nav -->
    <nav x-show="open" @click.away="open = false" class="md:hidden px-4 pb-4 space-y-1 bg-white/80 backdrop-blur-sm">
        <a href="{{ route('menu.index') }}" 
           class="block py-3 px-4 rounded-xl transition-all duration-300
                  {{ request()->routeIs('menu.index') || request()->routeIs('menu.show') 
                     ? 'text-orange-600 bg-orange-50 border-l-4 border-orange-500' 
                     : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
            <i class="fas fa-home mr-3"></i>Home
        </a>

        @auth
            @if (Auth::user()->role === 'user')
                <a href="{{ route('menu.index') }}#product" 
                class="block py-3 px-4 rounded-xl transition-all duration-300 relative group
                        {{ request()->routeIs('menu.index') && Str::contains(request()->getRequestUri(), '#product') 
                            ? 'text-orange-600 bg-orange-50' 
                            : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
                    <i class="fas fa-utensils mr-3"></i>Menu
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-500 to-amber-500 transition-all duration-300 group-hover:w-full
                        {{ request()->routeIs('menu.index') && Str::contains(request()->getRequestUri(), '#product') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ route('favorites.index') }}" 
                   class="block py-3 px-4 rounded-xl transition-all duration-300
                          {{ request()->routeIs('favorites.index') 
                             ? 'text-orange-600 bg-orange-50 border-l-4 border-orange-500' 
                             : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
                    <i class="fas fa-heart mr-3"></i>Favorit Saya
                </a>

            @elseif (Auth::user()->role === 'admin')
                <a href="{{ route('pengguna.index') }}" 
                   class="block py-3 px-4 rounded-xl transition-all duration-300
                          {{ request()->routeIs('pengguna.*') 
                             ? 'text-orange-600 bg-orange-50 border-l-4 border-orange-500' 
                             : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
                    <i class="fas fa-users mr-3"></i>Pengguna
                </a>
                
                <a href="{{ route('produk.create') }}" 
                   class="block py-3 px-4 rounded-xl transition-all duration-300
                          {{ request()->routeIs('produk.create') 
                             ? 'text-orange-600 bg-orange-50 border-l-4 border-orange-500' 
                             : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
                    <i class="fas fa-plus-circle mr-3"></i>+ Produk
                </a>
                
                <a href="{{ route('aktivitas') }}" 
                   class="block py-3 px-4 rounded-xl transition-all duration-300
                          {{ request()->routeIs('aktivitas') 
                             ? 'text-orange-600 bg-orange-50 border-l-4 border-orange-500' 
                             : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
                    <i class="fas fa-chart-line mr-3"></i>Aktivitas
                </a>
            @endif
        @endauth

        <a href="{{ route('orders.list') }}" 
           class="block py-3 px-4 rounded-xl transition-all duration-300
                  {{ request()->routeIs('orders.*') 
                     ? 'text-orange-600 bg-orange-50 border-l-4 border-orange-500' 
                     : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
            <i class="fas fa-shopping-bag mr-3"></i>Pesanan
        </a>

        <a href="{{ route('profil') }}" 
           class="block py-3 px-4 rounded-xl transition-all duration-300
                  {{ request()->routeIs('profil') 
                     ? 'text-orange-600 bg-orange-50 border-l-4 border-orange-500' 
                     : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
            <i class="fas fa-user mr-3"></i>Profil
        </a>
    </nav>
</header>
