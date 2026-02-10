@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tabel /</span> Edit Data Saldo
        </h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('saldo.update', $saldos->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nama_e_wallet">
                                    Nama E-Wallet
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="bx bx-wallet"></i>
                                        </span>
                                        <input type="text" class="form-control" id="nama_e_wallet" name="nama_e_wallet"
                                            value="{{ old('nama_e_wallet', $saldos->nama_e_wallet) }}" required />
                                    </div>
                                    @error('nama_e_wallet')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="total_saldo">
                                    Total Saldo
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="bx bx-money"></i>
                                        </span>
                                        <input type="number" class="form-control" id="total_saldo" name="total_saldo"
                                            value="{{ old('total_saldo', $saldos->total_saldo) }}" required />
                                    </div>
                                    @error('total_saldo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6 d-grid">
                                    <a href="{{ route('saldo.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </a>
                                </div>
                                <div class="col-sm-6 d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection