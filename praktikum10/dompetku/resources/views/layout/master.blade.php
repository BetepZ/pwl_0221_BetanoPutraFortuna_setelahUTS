<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DompetKu - @yield('title')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-indigo-600 tracking-tighter">DompetKu</h1>
            </div>
            <nav class="mt-6 px-6 space-y-2">
                <!-- Dashboard -->
                <a href="{{ url('/') }}" class="block px-4 py-2.5 {{ request()->is('/') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg font-medium">
                    Dashboard
                </a>

                <!-- Tambah Transaksi -->
                <a href="{{ url('/transaksi/create') }}" class="block px-4 py-2.5 {{ request()->is('transaksi/create') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg transition">
                    Tambah Transaksi
                </a>

                <!-- Laporan VIP (PERBAIKAN DISINI) -->
                <!-- Tambahkan ?type=vip agar lolos Middleware -->
                <a href="{{ url('/laporan?type=vip') }}" class="block px-4 py-2.5 {{ request()->is('laporan') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg transition">
                    Laporan (VIP)
                </a>

                <!-- Tombol Logout (Tambahan biar gampang logout) -->
                <a href="{{ url('/logout') }}" class="block px-4 py-2.5 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition mt-8">
                    Keluar / Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header Mobile -->
            <header class="bg-white shadow-sm border-b border-gray-200 p-4 md:hidden">
                <h1 class="text-xl font-bold text-indigo-600">DompetKu</h1>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-4 md:p-8">
                <!-- Flash Message Success -->
                @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r shadow-sm">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <!-- Flash Message Error -->
                @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r shadow-sm">
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>