<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelanjaan Desa Tahun {{ $filterYear }}</title>
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
            font-size: 8pt;
        }

        th {
            background-color: #f2f2f2;
        }

        .kop {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
            width: 100%;
        }
    </style>
</head>

<body>
    <img src="{{ public_path('dist/img/kopsurat.jpg') }}" alt="" class="kop">
    <h3 style="text-align: center;">Pembelanjaan Desa Tahun {{ $filterYear }}</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Transaksi</th>
                <th>Uraian</th>
                <th>Bidang</th>
                <th>Sumber Dana</th>
                <th>Jumlah Anggaran Dana yang di Pakai</th>
                <th>Bukti Transaksi</th>
                <th>Foto Kegiatan</th>
                <th>Terlaksana</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelanjaans as $pembelanjaan)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($pembelanjaan->tgl_transaksi ?? '')->locale('id')->translatedFormat('d F Y') }}
                    </td>
                    <td>
                        {{ $pembelanjaan->uraian ?? '' }}
                    </td>
                    <td>
                        {{ $pembelanjaan->rAnggaran->bidang ?? '' }}
                    </td>
                    <td>
                        {{ $pembelanjaan->rPendapatan->sumber_dana ?? '' }}
                    </td>
                    <td>
                        Rp. {{ number_format($pembelanjaan->jumlah_anggaran, 0, ',', '.') }}
                    </td>
                    <td>
                        <img src="{{ public_path('dist/assets/img/transaksi/' . $pembelanjaan->img_transaksi ?? '') }}"
                            alt="{{ $pembelanjaan->img_transaksi ?? '' }}" class="img-fluid img-thumbnail"
                            style="max-width: 100px">
                    </td>
                    <td>
                        @if ($pembelanjaan->img_kegiatan)
                            @foreach (explode(',', $pembelanjaan->img_kegiatan) as $kegiatan)
                                @if (trim($kegiatan) != '')
                                    <p class="mb-0 text-xs">
                                        <a href="{{ public_path('dist/assets/img/kegiatan/' . trim($kegiatan)) }}"
                                            target="_blank">
                                            Kegiatan {{ $loop->iteration }}
                                        </a>
                                    </p>
                                @endif
                            @endforeach
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>
                        @if ($pembelanjaan->img_terealisasi)
                            <img src="{{ public_path('dist/assets/img/terealisasi/' . $pembelanjaan->img_terealisasi ?? '') }}"
                                alt="{{ $pembelanjaan->img_terealisasi ?? '' }}" class="img-fluid img-thumbnail"
                                style="max-width: 100px">
                        @else
                            <span>Tidak Ada</span>
                        @endif
                    </td>
                    <td>
                        {{ $pembelanjaan->status ?? '' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
