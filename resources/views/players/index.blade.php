<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamerLink - Cari Teman Mabar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                🎮 <span>GamerLink</span>
            </h1>
            <a href="{{ route('players.create') }}" 
               class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition-all duration-200 shadow">
                + Tambah Teman Mabar
            </a>
        </div>
    </nav>

    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Daftar Teman Mabar</h2>

        {{-- Filter Game --}}
        <div class="text-center mb-8">
            <form method="GET" action="{{ route('players.index') }}" class="inline-block">
                <select name="game" onchange="this.form.submit()"
                    class="bg-white border border-gray-300 p-2 rounded-lg shadow focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">🎮 Semua Game</option>
                    @foreach ($games as $game)
                        <option value="{{ $game }}" {{ ($selectedGame == $game) ? 'selected' : '' }}>
                            {{ $game }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-6 text-center shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Daftar Player --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($players as $player)
                <div
                    class="bg-white rounded-2xl p-5 text-center shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 duration-300 border-t-4 border-indigo-500">
                    
                    <div class="relative inline-block">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 blur opacity-50"></div>
                        @if ($player->photo_path)
                            <img src="{{ asset('storage/' . $player->photo_path) }}" alt="Foto"
                                class="relative w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-white shadow-md">
                        @else
                            <div
                                class="relative w-32 h-32 rounded-full bg-gray-200 mx-auto mb-4 flex items-center justify-center text-gray-500 text-4xl shadow-inner">
                                🎮
                            </div>
                        @endif
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800">{{ $player->name }}</h3>
                    <p class="text-gray-500 mb-3">{{ $player->game }}</p>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $player->whatsapp_number) }}?text={{ urlencode('Gas mabar bro! Gw nemu id lu dari GAMERLINK!' . asset('storage/' . $player->photo_path)) }}"
                        target="_blank"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-full font-medium transition-all duration-200 shadow">
                        💬 Chat WhatsApp
                    </a>

                    {{-- Tombol hapus hanya untuk pemilik --}}
                    @if (auth()->check() && auth()->id() == $player->user_id)
                        <form action="{{ route('players.destroy', $player->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
        🗑️ Hapus
    </button>
</form>

                    @endif
                </div>
            @empty
                <p class="text-center col-span-full text-gray-500 text-lg mt-10">
                    Belum ada teman mabar 😢
                </p>
            @endforelse
        </div>
    </div>

    <footer class="mt-12 py-6 bg-gray-200 text-center text-gray-600 text-sm">
        © {{ date('Y') }} GamerLink - Temukan teman mabar terbaikmu 🎮
    </footer>
</body>

</html>
