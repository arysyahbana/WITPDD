<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Uraian</th>
            <th>Bidang</th>
            <th>Sumber Dana</th>
            <th>Jumlah Anggaran Yang di Pakai</th>
            <th>Bukti Transaksi</th>
            <th>Bukti Terealisasi</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembelanjaan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($item->tgl_transaksi ?? '')->locale('id')->translatedFormat('d F Y') }}
                </td>
                <td>{{ $item->uraian ?? '' }}</td>
                <td>{{ $item->rAnggaran->bidang ?? '' }}</td>
                <td>{{ $item->rPendapatan->sumber_dana ?? '' }}</td>
                <td>Rp. {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
                <td>
                    @if (!empty($item->img_transaksi))
                        <p>Ada</p>
                    @else
                        <p>Tidak Ada</p>
                    @endif
                </td>
                <td>
                    @if (!empty($item->img_terealisasi))
                        <p>Ada</p>
                    @else
                        <p>Tidak Ada</p>
                    @endif
                </td>
                <td>{{ $item->status ?? '' }}</td>
        @endforeach
    </tbody>
</table>
