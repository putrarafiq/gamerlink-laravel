<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Teman Mabar - GamerLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-indigo-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">🎮 GamerLink</h1>
            <a href="{{ route('players.index') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-100">
                ← Kembali
            </a>
        </div>
    </nav>

    <div class="container mx-auto mt-10 max-w-lg bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Tambah Teman Mabar</h2>

        <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Nama</label>
                <input type="text" name="name" class="w-full border p-2 rounded-lg" required>
            </div>

            {{-- Pilihan Game --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Pilih Game</label>
                <select id="gameSelect" name="game" class="w-full border p-2 rounded-lg" required>
                    <option value="">-- Pilih Game --</option>
                    <option value="Mobile Legends">Mobile Legends</option>
                    <option value="Free Fire">Free Fire</option>
                    <option value="Roblox">Roblox</option>
                    <option value="Lainnya">Lainnya...</option>
                </select>
            </div>

            {{-- Input Game Lainnya --}}
            <div id="otherGameInput" class="mb-4 hidden">
                <label class="block font-semibold mb-2">Masukkan Nama Game</label>
                <input type="text" id="otherGame" class="w-full border p-2 rounded-lg" placeholder="Contoh: Valorant">
            </div>

            {{-- Nomor WhatsApp --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Nomor WhatsApp</label>
                <input type="text" name="whatsapp_number" class="w-full border p-2 rounded-lg" placeholder="Contoh: 6281234567890" required>
            </div>

            {{-- Foto --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Foto ID Game (opsional)</label>
                <input type="file" name="photo" class="w-full border p-2 rounded-lg">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold w-full hover:bg-indigo-700">
                Simpan
            </button>
        </form>
    </div>

    <script>
        const gameSelect = document.getElementById('gameSelect');
        const otherGameInput = document.getElementById('otherGameInput');
        const otherGame = document.getElementById('otherGame');

        gameSelect.addEventListener('change', function() {
            if (this.value === 'Lainnya') {
                otherGameInput.classList.remove('hidden');
                otherGame.setAttribute('name', 'game'); // aktifkan input 'Lainnya'
                gameSelect.removeAttribute('name');     // hilangkan name di select agar tidak double
            } else {
                otherGameInput.classList.add('hidden');
                gameSelect.setAttribute('name', 'game');
                otherGame.removeAttribute('name');
            }
        });
    </script>
</body>
</html>
