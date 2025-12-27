<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DompetKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex items-center justify-center h-screen">

    <div class="w-full max-w-sm bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-indigo-600 tracking-tighter">DompetKu</h1>
            <p class="text-gray-500 text-sm mt-2">Silakan masuk untuk melanjutkan</p>
        </div>

        <!-- Tampilkan Pesan Error Login -->
        @if(session('error'))
        <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4 border border-red-200">
            {{ session('error') }}
        </div>
        @endif

        <!-- Tampilkan Pesan Sukses Logout -->
        @if(session('success'))
        <div class="bg-green-50 text-green-600 p-3 rounded-lg text-sm mb-4 border border-green-200">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="admin@dompetku.com" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="admin" required>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2.5 rounded-lg hover:bg-indigo-700 transition">
                    Masuk
                </button>
            </div>
        </form>

        <p class="text-xs text-center text-gray-400 mt-6">
            Gunakan: admin@dompetku.com / admin
        </p>
    </div>

</body>

</html>