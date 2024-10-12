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
        @foreach ($pendapatan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tgl_input ?? '')->locale('id')->translatedFormat('d F Y') }}</td>
                <td>{{ $item->sumber_dana ?? '' }}</td>
                <td>Rp. {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
                <td>
                    @if (!empty($item->img))
                        <p>Ada</p>
                    @else
                        <p>Tidak Ada</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
