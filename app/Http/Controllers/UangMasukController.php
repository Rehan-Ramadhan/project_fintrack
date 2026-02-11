<?php

namespace App\Http\Controllers;

use App\Models\UangMasuk;
use App\Models\Saldo;
use Illuminate\Http\Request;

class UangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uangMasuks = UangMasuk::where('user_id', auth()->id())
            ->with('saldo')
            ->get();

        return view('uang_masuk.index', compact('uangMasuks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $saldos = Saldo::where('user_id', auth()->id())->get();
        return view('uang_masuk.create', compact('saldos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_saldo' => 'required',
            'nominal' => 'required|numeric',
            'keterangan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        $uangMasuks = new UangMasuk();
        // =========================================================
        // Menyimpan siapa yang melakukan transaksi
        // =========================================================
        $uangMasuks->user_id = auth()->id();

        $uangMasuks->id_saldo = $request->id_saldo;
        $uangMasuks->nominal = $request->nominal;
        $uangMasuks->keterangan = $request->keterangan;
        $uangMasuks->tanggal_masuk = $request->tanggal_masuk;
        $uangMasuks->save();

        // Update saldo e-wallet terkait
        $saldos = Saldo::findOrFail($request->id_saldo);
        $saldos->total_saldo = $saldos->total_saldo + $request->nominal;
        $saldos->save();

        return redirect()->route('uang_masuk.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $uangMasuks = UangMasuk::where('user_id', auth()->id())->findOrFail($id);

        return view('uang_masuk.show', compact('uangMasuks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $uangMasuks = UangMasuk::findOrFail($id);

        // Pastikan user tidak bisa edit data orang lain lewat URL
        if ($uangMasuks->user_id !== auth()->id()) {
            abort(403);
        }

        $saldos = Saldo::where('user_id', auth()->id())->get();
        return view('uang_masuk.edit', compact('uangMasuks', 'saldos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_saldo' => 'required',
            'nominal' => 'required|numeric',
            'keterangan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        // Ambil data uang masuk
        $uangMasuks = UangMasuk::findOrFail($id);

        // ========================================================
        // Cek apakah data ini benar milik user yang login
        // ========================================================
        if ($uangMasuks->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak untuk mengubah data ini.');
        }

        // 1. Reset saldo lama dulu (dikembalikan ke sebelum transaksi ini ada)
        $saldos = Saldo::findOrFail($uangMasuks->id_saldo);
        $saldos->total_saldo = $saldos->total_saldo - $uangMasuks->nominal;
        $saldos->save();

        // 2. Update data uang masuk dengan data baru
        $uangMasuks->id_saldo = $request->id_saldo;
        $uangMasuks->nominal = $request->nominal;
        $uangMasuks->keterangan = $request->keterangan;
        $uangMasuks->tanggal_masuk = $request->tanggal_masuk;
        $uangMasuks->save();

        // 3. Tambahkan nominal baru ke saldo yang terpilih
        $saldo_baru = Saldo::findOrFail($request->id_saldo);
        $saldo_baru->total_saldo = $saldo_baru->total_saldo + $request->nominal;
        $saldo_baru->save();

        return redirect()->route('uang_masuk.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $uangMasuks = UangMasuk::findOrFail($id);

        // ========================================================
        // Cek apakah data ini benar milik user yang login
        // ========================================================
        if ($uangMasuks->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak untuk menghapus data ini.');
        }

        // 1. Kurangi total saldo (karena uang masuknya dihapus/dibatalkan)
        $saldos = Saldo::findOrFail($uangMasuks->id_saldo);
        $saldos->total_saldo = $saldos->total_saldo - $uangMasuks->nominal;
        $saldos->save();

        // 2. Hapus data dari tabel uang_masuks
        $uangMasuks->delete();

        return redirect()->route('uang_masuk.index')->with('success', 'Data berhasil dihapus');
    }
}