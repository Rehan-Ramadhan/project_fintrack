@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Lihat Uang Masuk</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Detail Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">E-Wallet</label>
                            <div class="col-sm-10">
                                <span class="form-control bg-light">{{ $uangMasuks->saldo->nama_e_wallet }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <span class="form-control bg-light">Rp
                                    {{ number_format($uangMasuks->nominal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <span class="form-control bg-light">{{ $uangMasuks->tanggal_masuk }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <span class="form-control bg-light"
                                    style="height: auto;">{{ $uangMasuks->keterangan }}</span>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-6 d-grid">
                                <a href="{{ route('uang_masuk.edit', $uangMasuks->id) }}" class="btn btn-warning">Edit
                                    Data</a>
                            </div>
                            <div class="col-sm-6 d-grid">
                                <a href="{{ route('uang_masuk.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection