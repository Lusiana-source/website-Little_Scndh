<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Little Scndh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 to-blue-200 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-2xl">
        <!-- Logo & Heading -->
      <div class="text-center mb-6">
    <img src="{{ asset('storage/products/logo1.jpg') }}" 
         alt="Little Scndh Logo" 
         class="w-20 h-20 mx-auto mb-4 rounded-full shadow-lg border-4 border-white hover:shadow-xl transition duration-300">
    <h2 class="text-2xl font-bold text-gray-800">Login ke <span class="text-blue-600">Little Scndh</span></h2>
    <p class="text-sm text-gray-500">Masuk untuk mulai berbelanja!</p>
</div>

        <!-- Peringatan jika gagal login -->
        @if(session('errors'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                <strong>Oops!</strong> Email atau password salah.
            </div>
        @endif


        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2 text-blue-600"> Ingat saya
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-300 shadow">
                Masuk
            </button>
        </form>

        <!-- Link ke Register -->
        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar di sini</a>
        </p>
    </div>

</body>
</html>
