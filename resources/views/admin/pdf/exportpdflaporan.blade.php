<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Desa Tahun {{ $filterYear }}</title>
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
    <h1 style="text-align: center;">Laporan Keuangan Desa Tahun {{ $filterYear }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Jumlah Pendapatan</th>
                <th>Jumlah Pembelanjaan</th>
                <th>Surplus/Defisit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $index => $laporan)
                <tr>
                    <td>
                        {{ $index + 1 }}
                    </td>
                    <td>
                        {{ $laporan->year }}
                    </td>
                    <td>
                        Rp. {{ number_format($laporan->total_pendapatan, 0, ',', '.') }}
                    </td>
                    <td>
                        Rp. {{ number_format($laporan->total_pembelanjaan, 0, ',', '.') }}
                    </td>
                    <td>
                        Rp. {{ number_format($laporan->surplus_defisit, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
