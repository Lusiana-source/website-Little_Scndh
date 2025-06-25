<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Admin Little Scndh</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans antialiased">

    <div class="flex min-h-screen">

      <!-- Sidebar -->
@if (!request()->is('admin/products/create'))
<aside class="w-64 bg-gray-800 text-white flex flex-col p-6 space-y-4">
    <div class="text-2xl font-bold mb-4">
        <span class="text-blue-400">Little</span> Scndh
    </div>
    <nav class="flex-1">
        <ul class="space-y-2">
            <li>
                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/products') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                    Kelola Produk
                </a>
            </li>
             <li>
                <a href="{{ url('/admin/orders') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                    Data Pesanan
                </a>
            </li>
        </ul>
    </nav>
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded transition">
                Logout
            </button>
        </form>
    </div>
</aside>
@endif
        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">


            <section>
                @yield('content')
            </section>
        </main>
    </div>

</body>
</html>
