<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Keuangan ' . (Auth::user()->ormawa ? Auth::user()->ormawa->singkatan : 'Ormawa')) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 1. NOTIFIKASI SUKSES -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 2. FILTER KHUSUS AUDITOR DPM -->
            @if(Auth::user()->role == 'dpm')
                <div class="bg-white p-4 rounded-lg shadow-sm mb-6 max-w-7xl mx-auto">
                    <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-4">
                        <div class="flex-1">
                            <label for="filter_ormawa" class="block text-sm font-semibold text-gray-700 mb-1">Pilih Ormawa yang Ingin Diaudit:</label>
                            <select name="filter_ormawa" id="filter_ormawa" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($allOrmawa as $ormawa)
                                    <option value="{{ $ormawa->id }}" {{ $ormawaId == $ormawa->id ? 'selected' : '' }}>
                                        {{ $ormawa->nama_ormawa }} ({{ $ormawa->singkatan }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-6">
                            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 text-sm font-medium shadow">
                                🔍 Cek Laporan
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- 3. KOTAK RINGKASAN KEUANGAN -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Saldo Akhir -->
                <div class="bg-blue-600 text-white p-6 rounded-lg shadow-md">
                    <p class="text-sm font-semibold uppercase tracking-wide opacity-80">Saldo Akhir</p>
                    <h3 class="text-3xl font-bold mt-1">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h3>
                </div>

                <!-- Total Kas Masuk -->
                <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                    <p class="text-sm font-semibold uppercase tracking-wide opacity-80">Total Kas Masuk</p>
                    <h3 class="text-3xl font-bold mt-1">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
                </div>

                <!-- Total Kas Keluar -->
                <div class="bg-red-500 text-white p-6 rounded-lg shadow-md">
                    <p class="text-sm font-semibold uppercase tracking-wide opacity-80">Total Kas Keluar</p>
                    <h3 class="text-3xl font-bold mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- 4. TABEL RIWAYAT TRANSAKSI -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-bold text-gray-700">Riwayat Transaksi Keuangan</h3>
    <div class="flex space-x-2">
        <a href="{{ route('transactions.print', ['filter_ormawa' => $ormawaId ?? '']) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 font-medium">
            🖨️ Cetak Laporan
        </a>
        
        @if(Auth::user()->role == 'bendahara')
            <a href="{{ route('transactions.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Tambah Transaksi</a>
        @endif
    </div>
</div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-sm font-semibold">
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Keterangan</th>
                            <th class="p-3">Jenis</th>
                            <th class="p-3">Nota</th>
                            <th class="p-3 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestTransactions as $tx)
                        <tr class="border-b hover:bg-gray-50 text-gray-700">
                            <td class="p-3 text-sm">{{ $tx->tanggal }}</td>
                            <td class="p-3 font-medium">{{ $tx->keterangan }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs font-bold {{ $tx->jenis == 'masuk' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ strtoupper($tx->jenis) }}
                                </span>
                            </td>
                            <td class="p-3 text-sm">
                                @if($tx->bukti_nota)
                                    <a href="{{ asset('nota/' . $tx->bukti_nota) }}" target="_blank" class="text-blue-600 hover:underline font-medium flex items-center gap-1">
                                        👁️ Lihat Nota
                                    </a>
                                @else
                                    <span class="text-gray-400 italic text-xs">Tanpa Nota</span>
                                @endif
                            </td>
                            <td class="p-3 text-right font-semibold {{ $tx->jenis == 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400">Belum ada data transaksi keuangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>