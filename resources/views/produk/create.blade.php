<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        * { 
            font-family: "Poppins", sans-serif; 
        }
        
        ::-webkit-scrollbar { 
            width: 8px; 
            height: 8px; 
        }
        
        ::-webkit-scrollbar-track { 
            background: #f5f5f5; 
        }
        
        ::-webkit-scrollbar-thumb { 
            background: #fb923c; 
            border-radius: 4px; 
        }
        
        ::-webkit-scrollbar-thumb:hover { 
            background: #f97316; 
        }

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
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
            border-color: #f97316;
        }
        
        .floating-label {
            transition: all 0.2s ease-in-out;
        }
        
        .input-group:focus-within .floating-label {
            transform: translateY(-0.5rem) scale(0.9);
            color: #f97316;
        }
        
        .input-group.has-value .floating-label {
            transform: translateY(-0.5rem) scale(0.9);
            color: #6b7280;
        }
        
        .upload-area {
            transition: all 0.3s ease;
        }
        
        .upload-area:hover {
            border-color: #f97316;
            background-color: #fff7ed;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }
        
        .notification {
            animation: slideInDown 0.5s ease-out;
        }
        
        @keyframes slideInDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .form-container {
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gradient-to-b from-orange-50 via-orange-100 to-amber-100 min-h-screen">
    @include('components.navbar')
    
    <div class="container mx-auto px-4 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-2xl mb-6">
                <i class="fas fa-plus text-2xl text-orange-500"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Tambah <span class="gradient-text">Produk Baru</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Lengkapi informasi produk dengan detail yang akurat untuk menambahkan ke menu kami
            </p>
        </div>

        <!-- Form Container -->
        <div class="max-w-4xl mx-auto">
            <div class="glass-effect rounded-3xl shadow-2xl p-8 md:p-12 form-container">
                {{-- Notifikasi sukses --}}
                @if(session('success'))
                    <div class="notification bg-green-100 border border-green-400 text-green-700 p-4 rounded-2xl mb-8 flex items-center shadow-lg">
                        <div class="bg-green-500 rounded-full p-2 mr-4">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Berhasil!</h4>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="notification bg-red-100 border border-red-400 text-red-700 p-4 rounded-2xl mb-8 shadow-lg">
                        <div class="flex items-start">
                            <div class="bg-red-500 rounded-full p-2 mr-4 mt-1">
                                <i class="fas fa-exclamation text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-2">Terdapat kesalahan:</h4>
                                <ul class="space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-sm flex items-center">
                                            <i class="fas fa-circle text-xs mr-2"></i>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Grid Layout for Form Fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Nama Produk -->
                        <div class="lg:col-span-2">
                            <div class="input-group relative">
                                <input type="text" name="name" id="name" 
                                       class="w-full border-2 border-gray-200 rounded-2xl px-6 py-4 text-gray-700 placeholder-transparent input-focus transition-all duration-200 text-lg" 
                                       placeholder="Nama Produk" required value="{{ old('name') }}"
                                       onblur="toggleLabel(this)" onfocus="toggleLabel(this)" oninput="toggleLabel(this)">
                                <label for="name" class="floating-label absolute left-6 top-4 text-gray-500 pointer-events-none font-medium">
                                    <i class="fas fa-tag mr-2"></i>Nama Produk *
                                </label>
                            </div>
                        </div>

                        <!-- Harga -->
                        <div>
                            <div class="input-group relative">
                                <input type="number" name="price" id="price" 
                                       class="w-full border-2 border-gray-200 rounded-2xl px-6 py-4 text-gray-700 placeholder-transparent input-focus transition-all duration-200 text-lg" 
                                       placeholder="Harga" required step="0.01" value="{{ old('price') }}"
                                       onblur="toggleLabel(this)" onfocus="toggleLabel(this)" oninput="toggleLabel(this)">
                                <label for="price" class="floating-label absolute left-6 top-4 text-gray-500 pointer-events-none font-medium">
                                    <i class="fas fa-money-bill-wave mr-2"></i>Harga (Rp) *
                                </label>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <div class="input-group relative">
                                <input type="text" name="kategori" id="kategori" 
                                       class="w-full border-2 border-gray-200 rounded-2xl px-6 py-4 text-gray-700 placeholder-transparent input-focus transition-all duration-200 text-lg" 
                                       placeholder="Kategori" value="{{ old('kategori') }}"
                                       onblur="toggleLabel(this)" onfocus="toggleLabel(this)" oninput="toggleLabel(this)">
                                <label for="kategori" class="floating-label absolute left-6 top-4 text-gray-500 pointer-events-none font-medium">
                                    <i class="fas fa-list mr-2"></i>Kategori
                                </label>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="lg:col-span-2">
                            <div class="input-group relative">
                                <textarea name="description" id="description" rows="4"
                                          class="w-full border-2 border-gray-200 rounded-2xl px-6 py-4 text-gray-700 placeholder-transparent input-focus transition-all duration-200 resize-none text-lg" 
                                          placeholder="Deskripsi"
                                          onblur="toggleLabel(this)" onfocus="toggleLabel(this)" oninput="toggleLabel(this)">{{ old('description') }}</textarea>
                                <label for="description" class="floating-label absolute left-6 top-4 text-gray-500 pointer-events-none font-medium">
                                    <i class="fas fa-file-alt mr-2"></i>Deskripsi Produk
                                </label>
                            </div>
                        </div>

                        <!-- Upload Gambar -->
                        <div class="lg:col-span-2">
                            <label class="block text-lg font-semibold text-gray-700 mb-4">
                                <i class="fas fa-camera mr-2 text-orange-500"></i>Gambar Produk
                            </label>
                            <div class="upload-area border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-white/50">
                                <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="handleFileSelect(this)">
                                <div id="upload-content">
                                    <div class="w-20 h-20 mx-auto mb-4 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-orange-500"></i>
                                    </div>
                                    <p class="text-gray-600 mb-3 text-lg">
                                        <span class="font-semibold text-orange-600 cursor-pointer hover:text-orange-700 transition-colors" onclick="document.getElementById('image').click()">
                                            Klik untuk upload gambar
                                        </span>
                                        <br>atau drag & drop di sini
                                    </p>
                                    <p class="text-sm text-gray-500">PNG, JPG, GIF hingga 10MB</p>
                                </div>
                                <div id="file-preview" class="hidden">
                                    <img id="preview-image" class="mx-auto max-w-48 max-h-48 rounded-2xl mb-4 shadow-lg">
                                    <p id="file-name" class="text-lg font-medium text-gray-700 mb-2"></p>
                                    <button type="button" onclick="removeFile()" class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-xl transition-colors font-medium">
                                        <i class="fas fa-trash mr-2"></i>Hapus gambar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-8">
                        <button type="submit" class="btn-primary w-full text-white font-bold py-5 px-8 rounded-2xl shadow-2xl text-lg">
                            <span class="flex items-center justify-center">
                                <i class="fas fa-save mr-3 text-xl"></i>
                                Simpan Produk
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-md shadow-inner py-8 mt-20">
        <div class="container mx-auto px-4 text-center text-gray-700">
            <p class="text-lg">&copy; 2025 Teh Tangsel. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle floating labels
        function toggleLabel(input) {
            const inputGroup = input.closest('.input-group');
            if (input.value || input === document.activeElement) {
                inputGroup.classList.add('has-value');
            } else {
                inputGroup.classList.remove('has-value');
            }
        }

        // Initialize labels on page load
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                if (input.value) {
                    toggleLabel(input);
                }
            });
        });

        // Handle file selection
        function handleFileSelect(input) {
            const file = input.files[0];
            const uploadContent = document.getElementById('upload-content');
            const filePreview = document.getElementById('file-preview');
            const previewImage = document.getElementById('preview-image');
            const fileName = document.getElementById('file-name');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    fileName.textContent = file.name;
                    uploadContent.classList.add('hidden');
                    filePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        // Remove selected file
        function removeFile() {
            const input = document.getElementById('image');
            const uploadContent = document.getElementById('upload-content');
            const filePreview = document.getElementById('file-preview');
            
            input.value = '';
            uploadContent.classList.remove('hidden');
            filePreview.classList.add('hidden');
        }

        // Drag and drop functionality
        const uploadArea = document.querySelector('.upload-area');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadArea.classList.add('border-orange-500', 'bg-orange-50');
        }

        function unhighlight(e) {
            uploadArea.classList.remove('border-orange-500', 'bg-orange-50');
        }

        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            const input = document.getElementById('image');
            
            if (files.length > 0) {
                input.files = files;
                handleFileSelect(input);
            }
        }
    </script>
</body>
</html>