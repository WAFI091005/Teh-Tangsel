<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aktivitas Pemesanan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-50 min-h-screen">

    @include('components.navbar')

    <div class="max-w-6xl mx-auto py-10 px-4">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center sm:text-left">Aktivitas Pemesanan Produk</h1>

        <div class="bg-white shadow-md rounded-xl p-4 sm:p-6 mb-10">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4 text-center sm:text-left">Diagram Jumlah Pemesanan per Produk</h2>
            <div class="w-full h-[300px] sm:h-[400px] relative">
                <canvas id="chartPesanan" class="absolute top-0 left-0 w-full h-full"></canvas>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-xl p-4 sm:p-6">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4 text-center sm:text-left">Detail Aktivitas Pemesanan</h2>

            @foreach($produkTerjual as $productId => $items)
                <div class="mb-6">
                    <h3 class="text-base sm:text-lg font-semibold text-orange-600">{{ $items->first()->product->name }}</h3>
                    <ul class="list-disc pl-5 sm:pl-6 text-gray-700 text-sm mt-2 space-y-1">
                        @foreach($items as $item)
                            <li>
                                Dibeli oleh: <strong>{{ $item->order->user->name }}</strong> 
                                ({{ $item->order->created_at->format('d M Y, H:i') }}) 
                                sebanyak <strong>{{ $item->quantity }}</strong> pcs
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chartPesanan');
        const dataChart = @json($dataChart);

        const warna = [
            'rgba(249, 115, 22, 0.7)',
            'rgba(59, 130, 246, 0.7)',
            'rgba(34, 197, 94, 0.7)',
            'rgba(244, 63, 94, 0.7)',
            'rgba(139, 92, 246, 0.7)',
            'rgba(234, 179, 8, 0.7)',
            'rgba(20, 184, 166, 0.7)',
            'rgba(168, 85, 247, 0.7)',
            'rgba(251, 191, 36, 0.7)',
            'rgba(255, 99, 132, 0.7)'
        ];

        const border = warna.map(color => color.replace('0.7', '1'));

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: dataChart.map(item => item.name),
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: dataChart.map(item => item.count),
                    backgroundColor: dataChart.map((_, i) => warna[i % warna.length]),
                    borderColor: dataChart.map((_, i) => border[i % border.length]),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: false }
                }
            }
        });
    </script>
</body>
</html>
