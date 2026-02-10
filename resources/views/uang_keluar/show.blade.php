@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Lihat Uang Keluar</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Detail Pengeluaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2">E-Wallet</label>
                            <div class="col-sm-10"><span
                                    class="form-control bg-light">{{ $uangKeluars->saldo->nama_e_wallet }}</span></div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2">Nominal</label>
                            <div class="col-sm-10"><span class="form-control bg-light text-danger">Rp
                                    {{ number_format($uangKeluars->nominal, 0, ',', '.') }}</span></div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2">Tanggal</label>
                            <div class="col-sm-10"><span
                                    class="form-control bg-light">{{ $uangKeluars->tanggal_keluar }}</span></div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2">Keterangan</label>
                            <div class="col-sm-10"><span class="form-control bg-light">{{ $uangKeluars->keterangan }}</span>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-6 d-grid"><a href="{{ route('uang_keluar.edit', $uangKeluars->id) }}"
                                    class="btn btn-warning">Edit Data</a></div>
                            <div class="col-sm-6 d-grid"><a href="{{ route('uang_keluar.index') }}"
                                    class="btn btn-secondary">Kembali</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection