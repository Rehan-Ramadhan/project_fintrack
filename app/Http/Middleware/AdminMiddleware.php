<?php
// ========================================
// FUNGSI: Membatasi akses hanya untuk user dengan role 'admin'
// ========================================

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Method ini dipanggil SETIAP KALI ada request yang melewati middleware ini.
     *
     * @param Request $request   Request dari user
     * @param Closure $next      Fungsi untuk melanjutkan ke proses berikutnya
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ================================================
        // STEP 1: Cek apakah user sudah login
        // ================================================
        if (!auth()->check()) {
            // auth()->check() = return true jika sudah login, false jika belum
            // !auth()->check() = NOT login = belum login

            return redirect()->route('login');
            // ↑ Redirect ke halaman login jika paksa akses tanpa akun
        }

        // ================================================
        // STEP 2: Cek apakah user memiliki role 'admin'
        // ================================================
        if (auth()->user()->role !== 'admin') {
            // auth()->user()->role = Ambil nilai kolom 'role' dari tabel users
            // !== 'admin'          = Jika nilainya bukan admin (misal: pengguna)

            abort(403, 'Maaf, halaman ini hanya dapat diakses oleh Administrator.');
            // ↑ abort(403) = Tampilkan error Forbidden
            // Memberitahu user bahwa mereka tidak punya hak akses.
        }

        // ================================================
        // STEP 3: Lanjutkan jika semua pengecekan lolos
        // ================================================
        return $next($request);
        // ↑ Meneruskan request ke Controller atau Route berikutnya
    }
}