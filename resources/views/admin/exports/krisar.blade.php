<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Gambar</th>
            <th>Kritik</th>
            <th>Saran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($krisar as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at ?? '')->locale('id')->translatedFormat('d F Y') }}</td>
                <td>{{ $item->nama ?? '' }}</td>
                <td>{{ $item->hp ?? '' }}</td>
                <td>
                    @if (!empty($item->gambar))
                        Ada
                    @else
                        Tidak Ada
                    @endif
                </td>
                <td>{{ $item->kritik ?? '' }}</td>
                <td>{{ $item->saran ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
