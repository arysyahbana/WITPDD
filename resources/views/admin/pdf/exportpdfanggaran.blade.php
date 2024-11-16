<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggaran Desa Tahun {{ $filterYear }}</title>
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
    <h1 style="text-align: center;">Anggaran Desa Tahun {{ $filterYear }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Bidang</th>
                <th>Jumlah Anggaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggarans as $anggaran)
                <tr>
                    <th>
                        {{ $loop->iteration }}
                    </th>
                    <td>
                        {{ \Carbon\Carbon::parse($anggaran->tgl_input ?? '')->locale('id')->translatedFormat('d F Y') }}
                    </td>
                    <td>
                        {{ $anggaran->bidang ?? '' }}
                    </td>
                    <td>
                        Rp. {{ number_format($anggaran->jumlah_anggaran, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>