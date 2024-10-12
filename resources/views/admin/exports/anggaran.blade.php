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
        @foreach ($anggaran as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tgl_input ?? '')->locale('id')->translatedFormat('d F Y') }}</td>
                <td>{{ $item->bidang ?? '' }}</td>
                <td>Rp. {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
