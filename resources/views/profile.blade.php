{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { font-family: 'Poppins', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #fb923c; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .gradient-text {
            background-image: linear-gradient(45deg, #f97316, #f59e0b);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradient 4s ease infinite;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gradient-to-b from-orange-50 via-orange-100 to-amber-100 min-h-screen">

    @include('components.navbar')

    <div class="flex justify-center mt-20">
        <div class="bg-white/80 backdrop-blur-xl shadow-2xl p-10 rounded-3xl w-full max-w-3xl transition transform hover:scale-[1.01] duration-300">
            <div class="text-center mb-10">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=fb923c&color=fff&size=128" alt="Avatar" class="mx-auto w-28 h-28 rounded-full shadow-lg border-4 border-white">
                <h1 class="text-3xl font-bold mt-4 gradient-text">Halo, {{ $user->name }}!</h1>
                <p class="text-gray-600">Selamat datang di halaman profil Anda</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-gray-700 text-base">
                <div>
                    <label class="block text-sm text-gray-500 font-semibold mb-1">Nama Lengkap</label>
                    <div class="p-3 bg-orange-50 rounded-lg shadow-inner">{{ $user->name }}</div>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 font-semibold mb-1">Email</label>
                    <div class="p-3 bg-orange-50 rounded-lg shadow-inner">{{ $user->email }}</div>
                </div>
            </div>

            <div class="mt-10 text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-semibold py-3 px-8 rounded-full transition duration-300 shadow-lg hover:shadow-orange-300">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { font-family: 'Poppins', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #fb923c; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .gradient-text {
            background-image: linear-gradient(45deg, #f97316, #f59e0b);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradient 4s ease infinite;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gradient-to-b from-orange-50 via-orange-100 to-amber-100 min-h-screen">

    @include('components.navbar')

    <div class="flex justify-center mt-20" x-data="{ editMode: false }">
        <div class="bg-white/80 backdrop-blur-xl shadow-2xl p-10 rounded-3xl w-full max-w-3xl transition transform hover:scale-[1.01] duration-300">

            <!-- Header -->
            <div class="text-center mb-10">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=fb923c&color=fff&size=128" alt="Avatar" class="mx-auto w-28 h-28 rounded-full shadow-lg border-4 border-white">
                <h1 class="text-3xl font-bold mt-4 gradient-text">Halo, {{ $user->name }}!</h1>
                <p class="text-gray-600">Selamat datang di halaman profil Anda</p>
            </div>

            <!-- Detail Profil -->
            <div x-show="!editMode" class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-gray-700 text-base">
                <div>
                    <label class="block text-sm text-gray-500 font-semibold mb-1">Nama Lengkap</label>
                    <div class="p-3 bg-orange-50 rounded-lg shadow-inner">{{ $user->name }}</div>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 font-semibold mb-1">Email</label>
                    <div class="p-3 bg-orange-50 rounded-lg shadow-inner">{{ $user->email }}</div>
                </div>
            </div>

            <!-- Form Edit Profil -->
            <form x-show="editMode" method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700 text-base mt-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-sm text-gray-500 font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" required class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>
                <div>
                    <label for="email" class="block text-sm text-gray-500 font-semibold mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" required class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>
                <div class="col-span-2 flex justify-center gap-4 mt-4">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full transition shadow">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                    <button type="button" @click="editMode = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-3 rounded-full transition shadow">
                        Batal
                    </button>
                </div>
            </form>

            <!-- Tombol Aksi -->
            <div class="mt-10 flex justify-center gap-4" x-show="!editMode">
                <button @click="editMode = true" class="bg-white border border-orange-400 text-orange-600 hover:bg-orange-100 font-semibold py-2 px-6 rounded-full transition shadow hover:shadow-md">
                    <i class="fas fa-edit mr-2"></i> Edit Profil
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-semibold py-2 px-6 rounded-full transition shadow-md hover:shadow-orange-300">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
