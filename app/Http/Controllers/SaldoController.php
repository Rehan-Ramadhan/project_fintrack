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
        $saldos = Saldo::all();
        return view('saldo.index', compact('saldos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $saldos = Saldo::all();
        return view('saldo.create', compact('saldos'));
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
        $saldos = Saldo::findOrFail($id);
        return view('saldo.show', compact('saldos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $saldos = Saldo::findOrFail($id);
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

        $saldos = Saldo::findOrFail($id);
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
        $saldos = Saldo::findOrFail($id);
        $saldos->delete();

        return redirect()->route('saldo.index')->with('success', 'Data berhasil dihapus');
    }
}
