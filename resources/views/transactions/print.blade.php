<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan {{ $ormawa->nama_ormawa }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white; color: black; }
        }
    </style>
</head>
<body class="bg-gray-50 py-10" onload="window.print()">

    <div class="max-w-4xl mx-auto bg-white p-8 shadow rounded-lg border">
        
        <div class="no-print mb-6">
            <button onclick="window.close()" class="bg-gray-500 text-white px-4 py-2 rounded text-sm hover:bg-gray-600">
                ← Tutup Halaman
            </button>
        </div>

        <div class="text-center border-b-2 border-gray-800 pb-4 mb-6">
            <h1 class="text-2xl font-bold uppercase tracking-wide">Sistem Informasi Manajemen Ormawa</h1>
            <h2 class="text-xl font-semibold text-gray-700 uppercase">{{ $ormawa->nama_ormawa }} ({{ $ormawa->singkatan }})</h2>
            <p class="text-sm text-gray-500 mt-1">Laporan Rekapitulasi Kas Keuangan Internal</p>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6 text-center">
            <div class="border p-3 rounded bg-gray-50">
                <p class="text-xs font-bold text-gray-500 uppercase">Total Pemasukan</p>
                <p class="text-lg font-bold text-green-600">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</p>
            </div>
            <div class="border p-3 rounded bg-gray-50">
                <p class="text-xs font-bold text-gray-500 uppercase">Total Pengeluaran</p>
                <p class="text-lg font-bold text-red-600">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</p>
            </div>
            <div class="border p-3 rounded bg-blue-50 border-blue-200">
                <p class="text-xs font-bold text-blue-700 uppercase">Saldo Akhir</p>
                <p class="text-lg font-bold text-blue-800">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</p>
            </div>
        </div>

        <table class="w-full text-left border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-gray-800 text-sm font-bold border-b border-gray-300">
                    <th class="p-3 border border-gray-300">No</th>
                    <th class="p-3 border border-gray-300">Tanggal</th>
                    <th class="p-3 border border-gray-300">Keterangan / Deskripsi</th>
                    <th class="p-3 border border-gray-300">Jenis</th>
                    <th class="p-3 text-right border border-gray-300">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse($transactions as $tx)
                <tr class="text-sm text-gray-700 border-b border-gray-200">
                    <td class="p-3 border border-gray-300">{{ $no++ }}</td>
                    <td class="p-3 border border-gray-300">{{ $tx->tanggal }}</td>
                    <td class="p-3 font-medium border border-gray-300">{{ $tx->keterangan }}</td>
                    <td class="p-3 border border-gray-300 uppercase font-bold text-xs {{ $tx->jenis == 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $tx->jenis }}
                    </td>
                    <td class="p-3 text-right font-semibold border border-gray-300 {{ $tx->jenis == 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                        Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-400 border border-gray-300">Belum ada data transaksi keuangan resmi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-12 flex justify-between text-sm">
            <div class="text-center">
                <p>Mengetahui,</p>
                <p class="font-bold mt-16 underline">Ketua Umum Ormawa</p>
            </div>
            <div class="text-center">
                <p>Kota Kampus, {{ date('d F Y') }}</p>
                <p class="font-bold mt-16 underline">Bendahara Umum</p>
            </div>
        </div>

    </div>

</body>
</html>