<?php

namespace App\Http\Controllers;

use App\Models\UangKeluar;
use App\Models\Saldo;
use Illuminate\Http\Request;

class UangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uangKeluars = UangKeluar::where('user_id', auth()->id())
            ->with('saldo')
            ->get();

        return view('uang_keluar.index', compact('uangKeluars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $saldos = Saldo::where('user_id', auth()->id())->get();
        return view('uang_keluar.create', compact('saldos'));
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
            'tanggal_keluar' => 'required|date',
        ]);

        $uangKeluars = new UangKeluar();
        $uangKeluars->user_id = auth()->id();
        // ---------------------------
        $uangKeluars->id_saldo = $request->id_saldo;
        $uangKeluars->nominal = $request->nominal;
        $uangKeluars->keterangan = $request->keterangan;
        $uangKeluars->tanggal_keluar = $request->tanggal_keluar;
        $uangKeluars->save();

        // Uang Keluar: Saldo dikurangi (-)
        $saldos = Saldo::findOrFail($request->id_saldo);
        $saldos->total_saldo -= $request->nominal;
        $saldos->save();

        return redirect()->route('uang_keluar.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $uangKeluars = UangKeluar::where('user_id', auth()->id())->findOrFail($id);

        return view('uang_keluar.show', compact('uangKeluars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Pastikan data yang diedit adalah milik sendiri
        $uangKeluars = UangKeluar::where('user_id', auth()->id())->findOrFail($id);

        // Dropdown saldo hanya milik user yang login
        $saldos = Saldo::where('user_id', auth()->id())->get();

        return view('uang_keluar.edit', compact('uangKeluars', 'saldos'));
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
            'tanggal_keluar' => 'required|date',
        ]);

        // Ambil data uang keluar
        $uangKeluars = UangKeluar::findOrFail($id);

        // ========================================================
        // Cek apakah data ini benar milik user yang login
        // ========================================================
        if ($uangKeluars->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak untuk mengubah data ini.');
        }

        // 1. Reset saldo lama dulu (dikembalikan ke sebelum transaksi ini ada)
        // Karena ini Uang Keluar, reset berarti saldo ditambah kembali (+)
        $saldos = Saldo::findOrFail($uangKeluars->id_saldo);
        $saldos->total_saldo = $saldos->total_saldo + $uangKeluars->nominal;
        $saldos->save();

        // 2. Update data uang keluar dengan data baru
        $uangKeluars->id_saldo = $request->id_saldo;
        $uangKeluars->nominal = $request->nominal;
        $uangKeluars->keterangan = $request->keterangan;
        $uangKeluars->tanggal_keluar = $request->tanggal_keluar;
        $uangKeluars->save();

        // 3. Kurangi nominal baru dari saldo yang terpilih
        $saldo_baru = Saldo::findOrFail($request->id_saldo);
        $saldo_baru->total_saldo = $saldo_baru->total_saldo - $request->nominal;
        $saldo_baru->save();

        return redirect()->route('uang_keluar.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $uangKeluars = UangKeluar::findOrFail($id);

        // ========================================================
        // Cek apakah data ini benar milik user yang login
        // ========================================================
        if ($uangKeluars->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak untuk menghapus data ini.');
        }

        // 1. Tambahkan kembali total saldo (karena uang keluarnya dihapus/dibatalkan)
        $saldos = Saldo::findOrFail($uangKeluars->id_saldo);
        $saldos->total_saldo = $saldos->total_saldo + $uangKeluars->nominal;
        $saldos->save();

        // 2. Hapus data dari tabel uang_keluars
        $uangKeluars->delete();

        return redirect()->route('uang_keluar.index')->with('success', 'Data berhasil dihapus');
    }
}