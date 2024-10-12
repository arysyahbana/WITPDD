@extends('admin.app')

@section('title', 'Anggaran Dana Desa')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Anggaran Dana Desa</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-8">
                        <form action="#" method="GET" class="form-inline">
                            @csrf
                            <div class="form-group mb-2">
                                <select name="tahun" id="tahun" class="form-control form-control-sm">
                                    <option value="">Lihat Semua Anggaran</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->year }}">Lihat Anggaran Tahun {{ $year->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mb-2 ml-1"><i class="fas fa-filter"></i>
                                Filter</button>

                            <!-- Tombol Unduh Excel -->
                            @if (!empty(request('tahun')))
                                <a href="{{ route('anggaran.export', ['tahun' => request('tahun')]) }}"
                                    class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Excel
                                </a>
                            @else
                                <a href="{{ route('anggaran.export') }}" class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Semua Excel
                                </a>
                            @endif
                        </form>
                    </div>
                    <div class="col col-lg-8">
                        <div class="my-3">
                            <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                data-target="#addAnggaran"><i class="fas fa-plus fa-cog"></i> Tambah</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Bidang</th>
                                        <th>Jumlah Anggaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggaran as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->tgl_input ?? '')->locale('id')->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ $item->bidang ?? '' }}</td>
                                            <td>Rp. {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
                                            <td style="min-width: 150px">
                                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#editAnggaran{{ $item->id }}"><i
                                                        class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#hapusAnggaran{{ $item->id }}"><i
                                                        class="fa fa-trash-alt"></i>
                                                    Hapus</a>
                                            </td>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editAnggaran{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editAnggaranTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Anggaran
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('anggaran.update', $item->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="tgl_input"
                                                                        class="col-form-label">Tanggal</label>
                                                                    <input type="date" class="form-control"
                                                                        id="tgl_input" name="tgl_input"
                                                                        value="{{ $item->tgl_input ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="bidang"
                                                                        class="col-form-label">Bidang</label>
                                                                    <input type="text" class="form-control"
                                                                        id="bidang" name="bidang"
                                                                        value="{{ $item->bidang ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="anggaran" class="col-form-label">Jumlah
                                                                        Anggaran</label>
                                                                    <input type="number" class="form-control"
                                                                        id="anggaran" name="jumlah_anggaran" min="0"
                                                                        step="0.01"
                                                                        value="{{ $item->jumlah_anggaran ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-primary">Perbarui</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="hapusAnggaran{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="hapusAnggaranTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Hapus
                                                                Anggaran
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
                                                            <a href="{{ route('anggaran.destroy', $item->id) }}"
                                                                class="btn btn-sm btn-danger">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="addAnggaran" tabindex="-1" role="dialog" aria-labelledby="addAnggaranTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Anggaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('anggaran.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tgl_input" class="col-form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tgl_input" name="tgl_input">
                            </div>
                            <div class="form-group">
                                <label for="bidang" class="col-form-label">Bidang</label>
                                <input type="text" class="form-control" id="bidang" name="bidang">
                            </div>
                            <div class="form-group">
                                <label for="anggaran" class="col-form-label">Jumlah Anggaran</label>
                                <input type="number" class="form-control" id="anggaran" name="jumlah_anggaran"
                                    min="0" step="0.01">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
