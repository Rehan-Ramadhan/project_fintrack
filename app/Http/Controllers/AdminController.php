<?php
// ========================================
// FUNGSI: Mengelola fitur khusus yang hanya bisa diakses oleh Admin
// ========================================

namespace App\Http\Controllers;

use App\Models\UangMasuk;
use App\Models\UangKeluar;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan riwayat transaksi dari SELURUH pengguna.
     * * Method ini mengambil data uang masuk dan uang keluar tanpa filter user_id,
     * sehingga Admin bisa memantau semua aktivitas keuangan.
     */
    public function riwayat()
    {
        // ================================================
        // STEP 1: Ambil semua data uang masuk
        // ================================================
        // Kita gunakan eager loading with('user', 'saldo') agar tidak berat (N+1 Problem)
        $semuaUangMasuk = UangMasuk::with(['user', 'saldo'])->latest()->get();

        // ================================================
        // STEP 2: Ambil semua data uang keluar
        // ================================================
        $semuaUangKeluar = UangKeluar::with(['user', 'saldo'])->latest()->get();

        // ================================================
        // STEP 3: Kirim data ke view admin
        // ================================================
        return view('admin.riwayat', compact('semuaUangMasuk', 'semuaUangKeluar'));
    }

    public function exportRiwayat(Request $request)
    {
        return Excel::download(new TransaksiExport, 'laporan-fintrack.xlsx');
    }

    public function exportPdf()
    {
        $semuaUangMasuk = UangMasuk::with('user')->get();
        $semuaUangKeluar = UangKeluar::with('user')->get();

        $data = [
            'title' => 'Laporan Keuangan Fintrack',
            'date' => date('d/m/Y'),
            'uangMasuk' => $semuaUangMasuk,
            'uangKeluar' => $semuaUangKeluar,
        ];

        // Load view khusus untuk tampilan PDF
        $pdf = Pdf::loadView('admin.laporan_pdf', $data);

        // Download file PDF
        return $pdf->download('laporan-fintrack-' . date('Y-m-d') . '.pdf');
    }
}