<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Little Scndh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-tr from-blue-100 to-white min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-2xl w-full max-w-md border border-blue-200">
        <div class="text-center mb-6">
            <img src="{{ asset('storage/products/logo1.jpg') }}"
                 alt="Little Scndh Logo"
                 class="w-20 h-20 mx-auto mb-4 rounded-full shadow-lg border-4 border-white hover:shadow-xl transition duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
            <p class="text-sm text-gray-500">Daftar untuk mulai berbelanja!</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition">
                Daftar
            </button>
        </form>

        <div class="mt-4 text-center">
    <a href="{{ route('login') }}"
       class="inline-flex items-center gap-2 text-sm text-blue-600 hover:underline hover:text-blue-800 transition">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Login</span>
    </a>
</div>


        <p class="mt-6 text-sm text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>

</body>
</html>
