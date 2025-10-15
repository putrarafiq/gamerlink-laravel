<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teman Mabar - GamerLink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg mt-10 shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-center text-yellow-400">Edit Teman Mabar</h2>

        <form action="{{ route('players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $player->name) }}" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>

            <div class="mb-3">
                <label class="block mb-1">Game</label>
                <input type="text" name="game" value="{{ old('game', $player->game) }}" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>

            <div class="mb-3">
                <label class="block mb-1">Nomor WhatsApp</label>
                <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $player->whatsapp_number) }}" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>

            <div class="mb-3">
                <label class="block mb-1">Foto ID Game (Opsional)</label>
                <input type="file" name="photo" class="w-full text-white">
                @if ($player->photo_path)
                    <img src="{{ asset('storage/' . $player->photo_path) }}" class="w-24 mt-2 rounded">
                @endif
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 w-full mt-3">
                Update
            </button>

            <a href="{{ route('players.index') }}" class="block text-center mt-3 text-gray-400 hover:text-yellow-400">Batal</a>
        </form>
    </div>
</body>
</html>
