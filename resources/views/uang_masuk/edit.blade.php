@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Edit Uang Masuk</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('uang_masuk.update', $uangMasuks->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="id_saldo">E-Wallet</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_saldo" id="id_saldo" required>
                                        @foreach($saldos as $data)
                                            <option value="{{ $data->id }}" {{ $data->id == $uangMasuks->id_saldo ? 'selected' : '' }}>
                                                {{ $data->nama_e_wallet }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nominal">Nominal</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nominal" id="nominal"
                                        value="{{ $uangMasuks->nominal }}" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tanggal_masuk">Tanggal Masuk</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk"
                                        value="{{ $uangMasuks->tanggal_masuk }}" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="2"
                                        required>{{ $uangMasuks->keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6 d-grid">
                                    <a href="{{ route('uang_masuk.index') }}" class="btn btn-secondary">
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