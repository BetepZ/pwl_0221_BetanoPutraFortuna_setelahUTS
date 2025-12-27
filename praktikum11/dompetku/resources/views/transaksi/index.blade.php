@extends('layout.master')
@section('title', 'Dashboard')
@section('content')

<!-- Card Statistik -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Saldo</h3>
        <p class="mt-2 text-3xl font-bold text-gray-900">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-emerald-500 uppercase tracking-wider">Pemasukan</h3>
        <p class="mt-2 text-3xl font-bold text-emerald-600">+ Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-rose-500 uppercase tracking-wider">Pengeluaran</h3>
        <p class="mt-2 text-3xl font-bold text-rose-600">- Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <h2 class="text-lg font-semibold text-gray-800">Riwayat Transaksi</h2>

        <!-- FITUR SEARCH (Soal 2) -->
        <div class="flex items-center gap-3 w-full md:w-auto">
            <form action="{{ url('/transaksi') }}" method="GET" class="flex w-full">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                    placeholder="Cari keterangan...">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700 text-sm font-medium">
                    Cari
                </button>
            </form>
            <a href="{{ url('/transaksi/create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 whitespace-nowrap">
                + Baru
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm">
                    <th class="px-6 py-3 font-medium">Tanggal</th>
                    <th class="px-6 py-3 font-medium">Keterangan</th>
                    <th class="px-6 py-3 font-medium">Jenis</th>
                    <th class="px-6 py-3 font-medium text-right">Nominal</th>
                    <th class="px-6 py-3 font-medium text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($dataTransaksi as $item)
                <tr class="hover:bg-gray-50 transition">
                    <!-- UBAH DARI ARRAY ['key'] KE OBJECT ->key KARENA ELOQUENT -->
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->keterangan }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($item->jenis == 'pemasukan')
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">Pemasukan</span>
                        @else
                        <span class="px-2 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold">Pengeluaran</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-right {{ $item->jenis == 'pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4 text-sm text-center">
                        <a href="{{ url('/transaksi/edit/' . $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold mr-3">Edit</a>
                        <form action="{{ url('/transaksi/' . $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-900 font-bold bg-transparent border-0 cursor-pointer">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Data tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- FITUR PAGINATION (Soal 2) -->
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $dataTransaksi->links() }}
    </div>
</div>
@endsection