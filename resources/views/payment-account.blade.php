<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan Akun Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
        <h2 class="text-xl font-bold mb-4">Daftarkan Akun PEMBAYARAN</h2>

        <!-- Pesan error (jika ada) -->
        <?php if (session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <?= session('error') ?>
            </div>
        <?php endif; ?>

        <form action="/payment-account/store" method="POST">
            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
            <input type="hidden" name="method" value="<?= htmlspecialchars(request('method')) ?>">

            <label class="block mb-4">
                Nomor Akun / Nomor HP:
                <input type="text" name="account_number" class="w-full border p-2 rounded mt-1" required>
            </label>

            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                Simpan
            </button>
        </form>
    </div>
</body>
</html>
