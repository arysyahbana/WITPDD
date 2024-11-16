<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendapatan Desa Tahun {{ $filterYear }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Pendapatan Desa Tahun {{ $filterYear }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Sumber Dana</th>
                <th>Jumlah Anggaran</th>
                <th>Bukti Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendapatans as $pendapatan)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($pendapatan->tgl_input ?? '')->locale('id')->translatedFormat('d F Y') }}
                    </td>
                    <td>
                        {{ $pendapatan->sumber_dana ?? '' }}
                    </td>
                    <td>
                        Rp. {{ number_format($pendapatan->jumlah_anggaran, 0, ',', '.') }}
                    </td>
                    <td>
                        <img src="{{ public_path('dist/assets/img/pendapatan/' . $pendapatan->img) }}"
                            alt="{{ $pendapatan->sumber_dana }}" style="max-width: 100px">

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
