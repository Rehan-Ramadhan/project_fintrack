@extends('layouts.app')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel/</span> Data Saldo</h4>
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <a href="{{ route('saldo.create') }}" class="btn btn-primary mb-3">
          <i class="bi bi-plus me-1"></i> Tambah Data
        </a>
        <div class="card">
          <h5 class="card-header">Tabel Saldo</h5>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama E-Wallet</th>
                  <th>Total Saldo</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php $no = 1; @endphp
                @foreach ($saldos as $data)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nama_e_wallet }}</td>
                    <td>Rp {{ number_format($data->total_saldo, 0, ',', '.') }}</td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('saldo.show', $data->id) }}">
                            <i class="bi bi-eye me-1"></i> Lihat
                          </a>
                          <a class="dropdown-item" href="{{ route('saldo.edit', $data->id) }}">
                            <i class="bi bi-pen me-1"></i> Edit
                          </a>
                          <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); if(confirm('Apakah Anda yakin?')) {document.getElementById('delete-form-{{ $data->id }}').submit();}">
                            <i class="bi bi-trash me-1"></i> Hapus
                          </a>
                          <form id="delete-form-{{ $data->id }}" action="{{ route('saldo.destroy', $data->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection