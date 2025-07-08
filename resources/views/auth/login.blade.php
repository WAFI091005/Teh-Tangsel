{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Teh Tangsel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 50%, #fdba74 100%);
        }
        
        .card-gradient {
            background: linear-gradient(145deg, #fed7aa, #fb923c);
        }
        
        .input-shadow {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-shadow {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .desktop-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        @media (min-width: 768px) {
            .desktop-card {
                animation: fadeInUp 0.8s ease-out;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            .float-animation { animation: float 3s ease-in-out infinite; }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">

    <!-- Mobile Layout -->
    <div class="md:hidden flex flex-col items-center min-h-screen">
        <!-- Header -->
        <div class="text-white text-center mt-8 mb-8">
            <h1 class="text-3xl font-bold mb-2">Hello!</h1>
            <p class="font-semibold text-lg opacity-90">Welcome to Teh Tangsel</p>
        </div>

        <!-- Login Card -->
        <div class="card-gradient w-full max-w-sm mx-4 px-6 py-8 rounded-t-3xl shadow-xl flex-1">
            <h2 class="text-2xl font-extrabold text-center mb-8 text-gray-800">LOGIN</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="relative mb-5">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-600">
                        <i class="fas fa-envelope text-lg"></i>
                    </span>
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-full focus:outline-none focus:ring-3 focus:ring-orange-400 input-shadow text-gray-700 font-medium"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="relative mb-5">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-600">
                        <i class="fas fa-lock text-lg"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-full focus:outline-none focus:ring-3 focus:ring-orange-400 input-shadow text-gray-700 font-medium"
                    >
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Login Button -->
                <div class="relative mt-8">
                    <div class="absolute -inset-1 bg-gradient-to-r from-white to-gray-200 rounded-full blur opacity-50"></div>
                    <button
                        type="submit"
                        class="relative w-full py-3 rounded-full bg-gradient-to-r from-white to-gray-100 text-gray-800 font-bold hover:from-gray-50 hover:to-white transition-all duration-300 btn-shadow text-lg transform hover:scale-105 hover:shadow-xl"
                    >
                        <span class="relative z-10">LOGIN</span>
                    </button>
                </div>

                <div class="text-center mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-700 underline hover:text-gray-800 transition-colors" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Desktop Layout -->
    <div class="hidden md:block min-h-screen relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 gradient-bg">
            <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-orange-400/20 rounded-full blur-3xl animate-bounce"></div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-pink-400/10 rounded-full blur-3xl animate-ping"></div>
        </div>
        
        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center p-8">
            <div class="desktop-card bg-white/15 backdrop-blur-3xl rounded-3xl shadow-2xl p-10 max-w-lg w-full border border-white/30 transform hover:scale-102 transition-all duration-500">
                <!-- Header with Enhanced Design -->
                <div class="text-center mb-10">
                    <div class="relative inline-block">
                        <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-white via-orange-200 to-pink-200 bg-clip-text text-transparent drop-shadow-2xl">
                            Hello!
                        </h1>
                        <div class="absolute -inset-2 bg-gradient-to-r from-orange-400 to-pink-400 rounded-full blur-lg opacity-20"></div>
                    </div>
                    <p class="font-semibold text-xl text-white/90 drop-shadow-lg">
                        Welcome to <span class="text-orange-200">Teh Tangsel</span>
                    </p>
                </div>

                <!-- Enhanced Login Card -->
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-orange-400 to-pink-400 rounded-2xl blur opacity-25"></div>
                    
                    <div class="relative card-gradient rounded-2xl p-8 shadow-2xl border border-white/20">
                        <h2 class="text-2xl font-extrabold text-center mb-8 text-gray-800">
                            LOGIN
                        </h2>

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <!-- Email Address -->
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-orange-400 to-pink-400 rounded-full opacity-0 group-hover:opacity-100 transition duration-300 blur"></div>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-600 z-10">
                                        <i class="fas fa-envelope text-lg"></i>
                                    </span>
                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="Email"
                                        value="{{ old('email') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 rounded-full focus:outline-none focus:ring-3 focus:ring-orange-400 input-shadow text-gray-700 font-medium text-base bg-white/95 backdrop-blur-sm transition-all duration-300 hover:bg-white"
                                    >
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-orange-400 to-pink-400 rounded-full opacity-0 group-hover:opacity-100 transition duration-300 blur"></div>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-600 z-10">
                                        <i class="fas fa-lock text-lg"></i>
                                    </span>
                                    <input
                                        type="password"
                                        name="password"
                                        placeholder="Password"
                                        required
                                        class="w-full pl-12 pr-4 py-3 rounded-full focus:outline-none focus:ring-3 focus:ring-orange-400 input-shadow text-gray-700 font-medium text-base bg-white/95 backdrop-blur-sm transition-all duration-300 hover:bg-white"
                                    >
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <!-- Login Button -->
                            <div class="relative mt-8">
                                <div class="absolute -inset-1 bg-gradient-to-r from-white to-gray-200 rounded-full blur opacity-50"></div>
                                <button
                                    type="submit"
                                    class="relative w-full py-3 rounded-full bg-gradient-to-r from-white to-gray-100 text-gray-800 font-bold hover:from-gray-50 hover:to-white transition-all duration-300 btn-shadow text-lg transform hover:scale-105 hover:shadow-xl"
                                >
                                    <span class="relative z-10">LOGIN</span>
                                </button>
                            </div>

                            <div class="text-center mt-6">
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-gray-700 underline hover:text-gray-800 transition-colors" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>