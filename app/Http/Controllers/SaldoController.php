<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya menampilkan saldo milik user yang sedang login
        $saldos = Saldo::where('user_id', auth()->id())->get();
        return view('saldo.index', compact('saldos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Di halaman create saldo tidak perlu panggil Saldo::all()
        return view('saldo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_e_wallet' => 'required|string|max:255',
            'total_saldo' => 'required|numeric|min:0',
        ], [
            'nama_e_wallet.required' => 'Nama E-Wallet wajib diisi.',
            'total_saldo.required' => 'Saldo awal wajib diisi.',
            'total_saldo.numeric' => 'Saldo harus berupa angka.',
        ]);

        $saldos = new Saldo();
        // =========================================================
        // Simpan ID user agar saldo tidak nyampur ke orang lain
        // =========================================================
        $saldos->user_id = auth()->id();

        $saldos->nama_e_wallet = $request->nama_e_wallet;
        $saldos->total_saldo = $request->total_saldo;
        $saldos->save();

        return redirect()->route('saldo.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Gunakan where user_id agar user tidak bisa intip ID saldo orang lain lewat URL
        $saldos = Saldo::where('user_id', auth()->id())->findOrFail($id);
        return view('saldo.show', compact('saldos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $saldos = Saldo::where('user_id', auth()->id())->findOrFail($id);
        return view('saldo.edit', compact('saldos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_e_wallet' => 'required|string|max:255',
            'total_saldo' => 'required|numeric|min:0',
        ], [
            'nama_e_wallet.required' => 'Nama E-Wallet wajib diisi.',
            'total_saldo.required' => 'Saldo awal wajib diisi.',
            'total_saldo.numeric' => 'Saldo harus berupa angka.',
        ]);

        $saldos = Saldo::where('user_id', auth()->id())->findOrFail($id);

        $saldos->nama_e_wallet = $request->nama_e_wallet;
        $saldos->total_saldo = $request->total_saldo;
        $saldos->save();

        return redirect()->route('saldo.index')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saldos = Saldo::where('user_id', auth()->id())->findOrFail($id);
        $saldos->delete();

        return redirect()->route('saldo.index')->with('success', 'Data berhasil dihapus');
    }
}