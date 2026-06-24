<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{ // <-- Kurung kurawal buka ini yang tadi hilang, bro!

    public function index(Request $request)
{
    $user = Auth::user();
    
    // Ambil daftar semua ormawa buat pilihan di menu dropdown filter (khusus DPM)
    $allOrmawa = \App\Models\Ormawa::all();

    // Secara default, ambil ormawa_id dari si user yang login
    $ormawaId = $user->ormawa_id;

    // TAPI, kalau dia DPM dan dia lagi milih filter ormawa lain di dropdown:
    if ($user->role == 'dpm' && $request->has('filter_ormawa') && $request->filter_ormawa != '') {
        $ormawaId = $request->filter_ormawa;
    }

    // Hitung ringkasan kas berdasarkan ormawa yang dipilih
    $totalMasuk = Transaction::where('ormawa_id', $ormawaId)->where('jenis', 'masuk')->sum('nominal');
    $totalKeluar = Transaction::where('ormawa_id', $ormawaId)->where('jenis', 'keluar')->sum('nominal');
    $saldoAkhir = $totalMasuk - $totalKeluar;

    // Ambil data transaksi berdasarkan ormawa yang dipilih
    $latestTransactions = Transaction::where('ormawa_id', $ormawaId)
        ->orderBy('tanggal', 'desc')
        ->get(); // Kita ambil semua biar bisa dilihat penuh

    return view('dashboard', compact('totalMasuk', 'totalKeluar', 'saldoAkhir', 'latestTransactions', 'allOrmawa', 'ormawaId'));
}

    // Fungsi untuk menampilkan halaman form input
    public function create()
    {
        return view('transactions.create');
    }

    // Fungsi untuk proses simpan data kas & nota
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jenis' => 'required|in:masuk,keluar',
            'nominal' => 'required|numeric|min:1',
            'bukti_nota' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $namaFileNota = null;

        // Logika Upload File Bukti Nota langsung ke folder public asli (Anti-403 Windows)
        if ($request->hasFile('bukti_nota')) {
            $file = $request->file('bukti_nota');
            $namaFileNota = 'nota_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('nota'), $namaFileNota); // Langsung masuk folder public/nota
        }

        // Simpan ke database
        Transaction::create([
            'ormawa_id' => Auth::user()->ormawa_id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'nominal' => $request->nominal,
            'bukti_nota' => $namaFileNota,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi kas berhasil dicatat!');
    }
    public function print(Request $request)
{
    $user = Auth::user();
    $ormawaId = $user->ormawa_id;

    // Kalau dia DPM dan lagi nyaring ormawa tertentu
    if ($user->role == 'dpm' && $request->has('filter_ormawa') && $request->filter_ormawa != '') {
        $ormawaId = $request->filter_ormawa;
    }

    $ormawa = \App\Models\Ormawa::find($ormawaId);
    
    // Tarik semua data kas milik ormawa ini
    $totalMasuk = Transaction::where('ormawa_id', $ormawaId)->where('jenis', 'masuk')->sum('nominal');
    $totalKeluar = Transaction::where('ormawa_id', $ormawaId)->where('jenis', 'keluar')->sum('nominal');
    $saldoAkhir = $totalMasuk - $totalKeluar;

    $transactions = Transaction::where('ormawa_id', $ormawaId)->orderBy('tanggal', 'asc')->get();

    return view('transactions.print', compact('totalMasuk', 'totalKeluar', 'saldoAkhir', 'transactions', 'ormawa'));
}
} // <-- Kurung kurawal tutup Class