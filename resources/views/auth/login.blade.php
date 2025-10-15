<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GamerLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-600 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-96">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">🎮 GamerLink</h1>
        <h2 class="text-xl font-semibold text-center mb-4">Login Akun</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-center">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-3 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                Masuk
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Belum punya akun?
            <a href="{{ url('/register') }}" class="text-indigo-600 font-semibold hover:underline">Daftar Sekarang</a>
        </p>
    </div>
</body>
</html>
