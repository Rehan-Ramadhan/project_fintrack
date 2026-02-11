<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 class="text-center">{{ $title }}</h2>
    <p class="text-center">Tanggal Cetak: {{ $date }}</p>

    <h3>1. Data Uang Masuk</h3>
    <table>
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uangMasuk as $m)
                <tr>
                    <td>{{ $m->user->name ?? 'User Terhapus' }}</td>
                    <td>{{ $m->tanggal_masuk }}</td>
                    <td>+ Rp {{ number_format($m->nominal, 0, ',', '.') }}</td>
                    <td>{{ $m->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>2. Data Uang Keluar</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uangKeluar as $k)
                <tr>
                    <td>{{ $k->user->name ?? 'User Terhapus' }}</td>
                    <td>{{ $k->tanggal_keluar }}</td>
                    <td>- Rp {{ number_format($k->nominal, 0, ',', '.') }}</td>
                    <td>{{ $k->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>