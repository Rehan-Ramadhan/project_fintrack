@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tabel /</span> Lihat Data Saldo
        </h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Lihat Data</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama_e_wallet">
                                Nama E-Wallet
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bi bi-wallet-fill"></i>
                                    </span>
                                    <span class="form-control bg-light">{{ $saldos->nama_e_wallet }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="total_saldo">
                                Total Saldo
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bi bi-currency-bitcoin"></i>
                                    </span>
                                    <span class="form-control bg-light">
                                        Rp {{ number_format($saldos->total_saldo, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-6 d-grid">
                                <a href="{{ route('saldo.edit', $saldos->id) }}" class="btn btn-warning">
                                    Edit Data
                                </a>
                            </div>
                            <div class="col-sm-6 d-grid">
                                <a href="{{ route('saldo.index') }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection