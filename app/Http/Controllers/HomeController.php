<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ================================================
        // Admin
        // ================================================
        if (auth()->user()->role == 'admin') {
            $data['total_transaksi'] = \App\Models\UangMasuk::count() + \App\Models\UangKeluar::count();
            $data['total_user'] = \App\Models\User::where('role', 'pengguna')->count();

            return view('home', $data);
        }

        // ================================================
        // Pengguna
        // ================================================
        $data['my_saldo'] = \App\Models\Saldo::where('user_id', auth()->id())->sum('total_saldo');

        return view('home', $data);
    }
}
