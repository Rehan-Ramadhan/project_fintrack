@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Edit Pengeluaran</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('uang_keluar.update', $uangKeluars->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="id_saldo">E-Wallet</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-wallet"></i></span>
                                        <select class="form-control @error('id_saldo') is-invalid @enderror" name="id_saldo"
                                            id="id_saldo">
                                            @foreach($saldos as $s)
                                                <option value="{{ $s->id }}" {{ old('id_saldo', $uangKeluars->id_saldo) == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_e_wallet }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_saldo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nominal">Nominal</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-money"></i></span>
                                        <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                                            name="nominal" id="nominal"
                                            value="{{ old('nominal', $uangKeluars->nominal) }}" />
                                    </div>
                                    @error('nominal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tanggal_keluar">Tanggal</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="date"
                                            class="form-control @error('tanggal_keluar') is-invalid @enderror"
                                            name="tanggal_keluar" id="tanggal_keluar"
                                            value="{{ old('tanggal_keluar', $uangKeluars->tanggal_keluar) }}" />
                                    </div>
                                    @error('tanggal_keluar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-note"></i></span>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                            name="keterangan" id="keterangan"
                                            rows="2">{{ old('keterangan', $uangKeluars->keterangan) }}</textarea>
                                    </div>
                                    @error('keterangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6 d-grid">
                                    <a href="{{ route('uang_keluar.index') }}" class="btn btn-secondary">
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