@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Admin /</span> Riwayat Transaksi Semua Pengguna
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.reports.export-pdf') }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                </a>

                <a href="{{ route('admin.reports.export-riwayat', request()->all()) }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="fw-semibold d-block mb-1">Total Seluruh Uang Masuk</span>
                                <div class="d-flex align-items-baseline">
                                    <h3 class="card-title mb-2 text-success">Rp
                                        {{ number_format($semuaUangMasuk->sum('nominal'), 0, ',', '.') }}
                                    </h3>
                                </div>
                                <small class="text-muted">Total dari semua pengguna</small>
                            </div>
                            <div class="avatar">
                                <span class="badge bg-label-success p-2">
                                    <i class="bx bx-trending-up"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="fw-semibold d-block mb-1">Total Seluruh Uang Keluar</span>
                                <div class="d-flex align-items-baseline">
                                    <h3 class="card-title mb-2 text-danger">Rp
                                        {{ number_format($semuaUangKeluar->sum('nominal'), 0, ',', '.') }}
                                    </h3>
                                </div>
                                <small class="text-muted">Total dari semua pengguna</small>
                            </div>
                            <div class="avatar">
                                <span class="badge bg-label-danger p-2">
                                    <i class="bx bx-trending-down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-masuk">
                        Uang Masuk
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-keluar">
                        Uang Keluar
                    </button>
                </li>
            </ul>
            <div class="tab-content px-0">
                <div class="tab-pane fade show active" id="navs-masuk" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Pemilik</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th>E-Wallet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($semuaUangMasuk as $masuk)
                                    <tr>
                                        <td><strong>{{ $masuk->user->name ?? 'User Terhapus' }}</strong></td>
                                        <td>{{ $masuk->tanggal_masuk }}</td>
                                        <td><span class="text-success fw-bold">Rp
                                                {{ number_format($masuk->nominal, 0, ',', '.') }}</span></td>
                                        <td>{{ $masuk->keterangan }}</td>
                                        <td><span class="badge bg-label-info">{{ $masuk->saldo->nama_saldo ?? '-' }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data uang masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-keluar" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Pemilik</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th>E-Wallet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($semuaUangKeluar as $keluar)
                                    <tr>
                                        <td><strong>{{ $keluar->user->name ?? 'User Terhapus' }}</strong></td>
                                        <td>{{ $keluar->tanggal_keluar }}</td>
                                        <td><span class="text-danger fw-bold">Rp
                                                {{ number_format($keluar->nominal, 0, ',', '.') }}</span></td>
                                        <td>{{ $keluar->keterangan }}</td>
                                        <td><span class="badge bg-label-info">{{ $keluar->saldo->nama_saldo ?? '-' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data uang keluar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection