<?php

namespace App\Exports;

use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Ambil semua data masuk & keluar dengan relasi user
        $masuk = UangMasuk::with('user')->get()->map(function ($item) {
            $item->tipe = 'MASUK';
            return $item;
        });

        $keluar = UangKeluar::with('user')->get()->map(function ($item) {
            $item->tipe = 'KELUAR';
            return $item;
        });

        return $masuk->concat($keluar);
    }

    public function headings(): array
    {
        return ['Nama Pengguna', 'Tipe', 'Nominal', 'Keterangan', 'Tanggal'];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->user->name ?? 'User Terhapus',
            $transaksi->tipe,
            $transaksi->nominal,
            $transaksi->keterangan,
            $transaksi->tanggal_masuk ?? $transaksi->tanggal_keluar,
        ];
    }
}