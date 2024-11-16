@extends('admin.app')

@section('title', 'Krisar')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Kritik dan Saran</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-8 mb-4">
                        <form action="#" method="GET" class="form-inline">
                            @csrf
                            <div class="form-group mb-2">
                                <select name="tahun" id="tahun" class="form-control form-control-sm">
                                    <option value="">Lihat Semua Kritik dan Saran</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->year }}">Lihat Kritik dan Saran Tahun {{ $year->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mb-2 ml-1"><i class="fas fa-filter"></i>
                                Filter</button>

                            <!-- Tombol Unduh Excel -->
                            @if (!empty(request('tahun')))
                                <a href="{{ route('krisar.export', ['tahun' => request('tahun')]) }}"
                                    class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Excel
                                </a>
                            @else
                                <a href="{{ route('krisar.export') }}" class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Semua Excel
                                </a>
                            @endif
                        </form>
                    </div>
                    <div class="col col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">No HP</th>
                                        <th class="text-center">Gambar</th>
                                        <th class="text-center">Kritik</th>
                                        <th class="text-center">Saran</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($krisar as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at ?? '')->locale('id')->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ $item->nama ?? '' }}</td>
                                            <td>{{ $item->hp ?? '' }}</td>
                                            <td>
                                                <a href="{{ asset('dist/assets/img/krisar/' . $item->gambar ?? '') }}"
                                                    target="_blank">
                                                    <img src="{{ asset('dist/assets/img/krisar/' . $item->gambar ?? '') }}"
                                                        alt="{{ $item->gambar ?? '' }}" class="img-fluid img-thumbnail"
                                                        style="max-width: 100px">
                                                </a>
                                            </td>
                                            <td style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                                {{ $item->kritik ?? '' }}</td>
                                            <td style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                                {{ $item->saran ?? '' }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#hapusKrisar{{ $item->id }}"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusKrisar{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="hapusKrisarTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus
                                                            Kritik dan Saran
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('dist/img/bin.gif') }}" alt=""
                                                            class="img-fluid w-25">
                                                        <p>Yakin ingin menghapus data?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <a href="{{ route('krisar.destroy', $item->id) }}"
                                                            class="btn btn-sm btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
