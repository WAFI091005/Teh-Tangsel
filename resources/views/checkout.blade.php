<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pembayaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-orange-100 font-sans">

@include('components.navbar')

  <main class="max-w-md mx-auto mt-4 p-4 bg-white rounded-lg shadow-md">
    <form action="{{ route('checkout.process') }}" method="POST">
      @csrf
      <h1 class="font-bold text-center text-2xl">PEMBAYARAN</h1>
      <!-- E-Wallet -->
      <h3 class="font-semibold text-gray-700 mt-4 mb-2">E-Wallet</h3>
      <div class="space-y-2">
        <label class="flex items-center border rounded-lg p-2 hover:bg-orange-50">
          <img src="{{ asset('images/dana.jpg') }}" class="w-8 h-8" alt="DANA">
          <div class="ml-3 flex-1">
            <div class="font-semibold">DANA</div>
            {{-- <div class="text-sm text-gray-500">Saldo: Rp.xxxxx</div> --}}
          </div>
          <input type="radio" name="payment_method" value="dana" class="accent-orange-500" required>
        </label>

        <label class="flex items-center border rounded-lg p-2 hover:bg-orange-50">
          <img src="{{ asset('images/gopay.jpg') }}" class="w-8 h-8" alt="GOPAY">
          <div class="ml-3 flex-1">
            <div class="font-semibold">GOPAY</div>
            {{-- <div class="text-sm text-gray-500">Saldo: Rp.xxxxx</div> --}}
          </div>
          <input type="radio" name="payment_method" value="gopay" class="accent-orange-500">
        </label>
      </div>

      <!-- Transfer Bank -->
      <h3 class="font-semibold text-gray-700 mt-6 mb-2">Transfer Bank</h3>
      <div class="space-y-2">
        <label class="flex items-center border rounded-lg p-2 hover:bg-orange-50">
          <img src="{{ asset('images/bca.jpg') }}" class="w-8 h-8" alt="BCA">
          <div class="ml-3 flex-1">
            <div class="font-semibold">BCA Virtual Account</div>
          </div>
          <input type="radio" name="payment_method" value="bca_va" class="accent-orange-500">
        </label>

        <label class="flex items-center border rounded-lg p-2 hover:bg-orange-50">
          <img src="{{ asset('images/bri.jpg') }}" class="w-8 h-8" alt="BRI">
          <div class="ml-3 flex-1">
            <div class="font-semibold">BRI Virtual Account</div>
          </div>
          <input type="radio" name="payment_method" value="bri_va" class="accent-orange-500">
        </label>
      </div>

      <!-- Cash -->
      <h3 class="font-semibold text-gray-700 mt-6 mb-2">Cash</h3>
      <label class="flex items-center border rounded-lg p-2 hover:bg-orange-50">
        <img src="https://cdn-icons-png.flaticon.com/512/3313/3313915.png" class="w-8 h-8" alt="COD">
        <div class="ml-3 flex-1">
          <div class="font-semibold">Bayar di Tempat (COD)</div>
        </div>
        <input type="radio" name="payment_method" value="cod" class="accent-orange-500">
      </label>

      <!-- Alamat Pengiriman -->
    <h3 class="font-semibold text-gray-700 mt-6 mb-2">Alamat Pengiriman</h3>
    <textarea name="shipping_address" required
      class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
      placeholder="Masukkan alamat lengkap...">{{ old('shipping_address') }}</textarea>


      <!-- Total dan tombol -->
      <div class="mt-6 flex justify-between items-center font-bold text-lg text-orange-700">
        <span>TOTAL</span>
        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
      </div>

      <button type="submit" class="w-full mt-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg">
        Bayar
      </button>
    </form>
  </main>
</body>
</html>
