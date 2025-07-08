<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pembayaran Berhasil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen font-sans">

  <div class="bg-white rounded-lg shadow-lg p-8 max-w-md text-center">
    <h1 class="text-3xl font-bold text-green-600 mb-4">Pembayaran Berhasil!</h1>
    <p class="mb-6 text-gray-700">Terima kasih sudah melakukan pembayaran. Pesananmu sedang kami proses.</p>
    <a href="{{ route('menu.index') }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 transition">
      Kembali ke Menu
    </a>
  </div>

</body>
</html>
