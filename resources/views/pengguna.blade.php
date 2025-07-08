<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .slide-in {
            animation: slideIn 0.8s ease-out forwards;
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
        
        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .pulse-scale {
            animation: pulseScale 2s infinite;
        }
        
        @keyframes pulseScale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .button-hover {
            transition: all 0.2s ease;
        }
        
        .button-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .role-badge {
            position: relative;
            overflow: hidden;
        }
        
        .role-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .role-badge:hover::before {
            left: 100%;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">

    @include('components.navbar')

    <div class="max-w-5xl mx-auto mt-10 px-4 pb-8">
        <div class="glass-card shadow-2xl rounded-3xl overflow-hidden p-8 slide-in">
            <h1 class="text-4xl font-extrabold mb-8 text-gray-800 text-center pulse-scale">
                ✨ Daftar Pengguna
            </h1>

            {{-- Grafik Pengguna --}}
            <div class="mb-12 fade-in">
                <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">
                    📊 Statistik Pengguna Berdasarkan Role
                </h2>
                <div class="bg-white rounded-2xl p-6 shadow-lg card-hover">
                    <canvas id="userChart" class="w-full max-w-xl mx-auto"></canvas>
                </div>
            </div>

            {{-- Notifikasi sukses/error --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl text-center font-medium shadow-lg slide-in">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @elseif(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl text-center font-medium shadow-lg slide-in">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                {{-- Desktop Table --}}
                <table class="hidden md:table w-full bg-white border border-gray-200 text-sm md:text-base rounded-2xl overflow-hidden shadow-lg">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">👤 Nama</th>
                            <th class="px-6 py-4 text-left font-semibold">📧 Email</th>
                            <th class="px-6 py-4 text-left font-semibold">🏷️ Role</th>
                            <th class="px-6 py-4 text-center font-semibold">⚡ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition-all duration-300 border-b border-gray-100">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="role-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($user->role === 'admin') bg-red-100 text-red-800
                                        @else bg-blue-100 text-blue-800
                                        @endif">
                                        @if($user->role === 'admin') 👑
                                        @else 👤
                                        @endif
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($user->role !== 'admin')
                                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button-hover inline-flex items-center justify-center bg-red-500 text-white px-4 py-2 rounded-xl hover:bg-red-600 transition-all duration-200 text-sm font-medium shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 italic text-sm bg-gray-100 px-3 py-1 rounded-full">
                                            🔒 Tidak bisa dihapus
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center px-6 py-12 text-gray-500">
                                    <div class="text-4xl mb-4">👥</div>
                                    <div class="font-medium">Tidak ada pengguna terdaftar.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Mobile Layout --}}
                <div class="md:hidden space-y-6 mt-6">
                    @forelse ($users as $user)
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-lg card-hover">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span class="text-gray-600 font-medium text-sm">👤 Nama:</span>
                                    </div>
                                    <div class="text-gray-900 font-semibold text-lg mb-3">{{ $user->name }}</div>
                                    
                                    <div class="flex items-center mb-2">
                                        <span class="text-gray-600 font-medium text-sm">📧 Email:</span>
                                    </div>
                                    <div class="text-gray-700 mb-3">{{ $user->email }}</div>
                                </div>
                                <span class="role-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold ml-4
                                    @if($user->role === 'admin') bg-red-100 text-red-800
                                    @else bg-blue-100 text-blue-800
                                    @endif">
                                    @if($user->role === 'admin') 👑
                                    @else 👤
                                    @endif
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100">
                                @if ($user->role !== 'admin')
                                    <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-hover w-full bg-red-500 text-white py-3 rounded-xl hover:bg-red-600 transition-all duration-200 text-sm font-semibold shadow-md flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            🗑️ Hapus Pengguna
                                        </button>
                                    </form>
                                @else
                                    <div class="text-center text-gray-400 italic bg-gray-50 py-3 rounded-xl">
                                        🔒 Tidak bisa dihapus
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-12">
                            <div class="text-6xl mb-4">👥</div>
                            <div class="text-xl font-medium">Tidak ada pengguna terdaftar.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Script Chart.js --}}
    <script>
        // Enhanced Chart with animations
        const ctx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($userCounts->keys()) !!},
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: {!! json_encode($userCounts->values()) !!},
                    backgroundColor: [
                        '#4F46E5',
                        '#10B981',
                        '#F59E0B',
                        '#EF4444',
                    ],
                    borderRadius: 12,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { 
                        display: false 
                    },
                    tooltip: {
                        callbacks: {
                            label: context => `${context.parsed.y} pengguna`
                        },
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { 
                            precision: 0,
                            color: '#6B7280'
                        },
                        grid: {
                            color: '#F3F4F6'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6B7280'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Add entrance animations to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr, .md\\:hidden > div');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.6s ease-out';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>

</body>
</html>