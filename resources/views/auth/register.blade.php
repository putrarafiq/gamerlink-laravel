<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GamerLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-600 to-indigo-600 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-96">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">🎮 GamerLink</h1>
        <h2 class="text-xl font-semibold text-center mb-4">Buat Akun Baru</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-center">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

       <form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <div>
        <label for="name" class="block text-gray-700">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
               class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-400">
    </div>

    <div>
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-400">
    </div>

    <div>
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" id="password" name="password"
               class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-400">
    </div>

    <div>
        <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-400">
    </div>

    <button type="submit"
            class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
        Daftar
    </button>
</form>


        <p class="text-center text-gray-600 text-sm mt-4">
            Sudah punya akun?
            <a href="{{ url('/login') }}" class="text-indigo-600 font-semibold hover:underline">Login di sini</a>
        </p>
    </div>
</body>
</html>
