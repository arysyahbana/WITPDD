@extends('admin.app')

@section('title', 'Pembelanjaan')

@section('main_content')
    <div class="container-fluid bg-light">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Pembelanjaan Dana Desa</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-11">
                        <form action="#" method="GET" class="form-inline">
                            @csrf
                            <div class="form-group mb-2">
                                <select name="tahun" id="tahun" class="form-control form-control-sm">
                                    <option value="">Lihat Semua Pembelanjaan</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->year }}">Lihat Pembelanjaan Tahun {{ $year->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mb-2 ml-1"><i class="fas fa-filter"></i>
                                Filter</button>

                            <!-- Tombol Unduh Excel -->
                            @if (!empty(request('tahun')))
                                <a href="{{ route('pembelanjaan.export', ['tahun' => request('tahun')]) }}"
                                    class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Excel
                                </a>
                            @else
                                <a href="{{ route('pembelanjaan.export') }}" class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Semua Excel
                                </a>
                            @endif
                        </form>
                    </div>
                    <div class="col col-lg-11">
                        <div class="my-3">
                            <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                data-target="#addPembelanjaan"><i class="fas fa-plus fa-cog"></i>Tambah Pembelanjaan</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Uraian</th>
                                        <th>Bidang</th>
                                        <th>Sumber Dana</th>
                                        <th>Jumlah Anggaran Yang di Pakai</th>
                                        <th>Bukti Transaksi</th>
                                        <th>Bukti Terealisasi</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembelanjaans as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->tgl_transaksi ?? '')->locale('id')->translatedFormat('d F Y') }}
                                            </td>
                                            <td style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                                {{ $item->uraian ?? '' }}</td>
                                            <td>{{ $item->rAnggaran->bidang ?? '' }}</td>
                                            <td>{{ $item->rPendapatan->sumber_dana ?? '' }}</td>
                                            <td>Rp. {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
                                            <td>
                                                <a href="{{ asset('dist/assets/img/transaksi/' . $item->img_transaksi ?? '') }}"
                                                    target="_blank">
                                                    <img src="{{ asset('dist/assets/img/transaksi/' . $item->img_transaksi ?? '') }}"
                                                        alt="{{ $item->img_transaksi ?? '' }}"
                                                        class="img-fluid img-thumbnail" style="max-width: 100px">
                                                </a>
                                            </td>
                                            <td>
                                                @if ($item->img_terealisasi)
                                                    <a href="{{ asset('dist/assets/img/terealisasi/' . $item->img_terealisasi ?? '') }}"
                                                        target="_blank">
                                                        <img src="{{ asset('dist/assets/img/terealisasi/' . $item->img_terealisasi ?? '') }}"
                                                            alt="{{ $item->img_terealisasi ?? '' }}"
                                                            class="img-fluid img-thumbnail" style="max-width: 100px">
                                                    </a>
                                                @else
                                                    <span>Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->status ?? '' }}</td>
                                            <td style="min-width: 150px">
                                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#editPembelanjaan{{ $item->id }}"><i
                                                        class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#hapusPembelanjaan{{ $item->id }}"><i
                                                        class="fa fa-trash-alt"></i>
                                                    Hapus</a>
                                            </td>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editPembelanjaan{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editPembelanjaanTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit
                                                                Pembelanjaan
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('pembelanjaan.update', $item->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="tgl_transaksi"
                                                                        class="col-form-label">Tanggal Transkasi</label>
                                                                    <input type="date" class="form-control"
                                                                        id="tgl_transaksi" name="tgl_transaksi"
                                                                        value="{{ $item->tgl_transaksi ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="uraian"
                                                                        class="col-form-label">Uraian</label>
                                                                    <textarea name="uraian" id="" cols="30" rows="5" class="form-control">{{ $item->uraian ?? '' }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="saldo_awal"
                                                                        class="col-form-label">Bidang</label>
                                                                    <select class="custom-select" name="anggaran_id">
                                                                        <option selected hidden>--- Pilih ---</option>
                                                                        @foreach ($anggarans as $bidang)
                                                                            <option value="{{ $bidang->id }}"
                                                                                {{ $item->anggaran_id == $bidang->id ? 'selected' : '' }}>
                                                                                {{ $bidang->bidang }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="saldo_awal" class="col-form-label">Sumber
                                                                        Dana</label>
                                                                    <select class="custom-select" name="pendapatan_id">
                                                                        <option selected hidden>--- Pilih ---</option>
                                                                        @foreach ($pendapatans as $pendapatan)
                                                                            <option value="{{ $pendapatan->id }}"
                                                                                {{ $item->pendapatan_id == $pendapatan->id ? 'selected' : '' }}>
                                                                                {{ $pendapatan->sumber_dana }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jumlah_anggaran"
                                                                        class="col-form-label">Jumlah Anggaran</label>
                                                                    <input type="number" class="form-control"
                                                                        id="jumlah_anggaran" name="jumlah_anggaran"
                                                                        min="0" step="0.01"
                                                                        value="{{ $item->jumlah_anggaran ?? '' }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="img_transaksi"
                                                                        class="col-form-label">Perbarui Bukti
                                                                        Transaksi</label>
                                                                    <a href="{{ asset('dist/assets/img/transaksi/' . $item->img_transaksi ?? '') }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('dist/assets/img/transaksi/' . $item->img_transaksi ?? '') }}"
                                                                            alt="{{ $item->img_transaksi ?? '' }}"
                                                                            class="img-fluid img-thumbnail"
                                                                            style="max-width: 300px">
                                                                    </a>
                                                                    <div class="input-group">
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                class="custom-file-input"
                                                                                id="img_transaksi" name="img_transaksi">
                                                                            <label class="custom-file-label"
                                                                                for="img_transaksi">Pilih Foto</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    @if ($item->img_terealisasi == null)
                                                                        <label for="img_terealisasi"
                                                                            class="col-form-label">Bukti
                                                                            Terealisasi</label>
                                                                    @else
                                                                        <label for="img_terealisasi"
                                                                            class="col-form-label">Perbarui Bukti
                                                                            Terealisasi</label>
                                                                        <a href="{{ asset('dist/assets/img/terealisasi/' . $item->img_terealisasi ?? '') }}"
                                                                            target="_blank">
                                                                            <img src="{{ asset('dist/assets/img/terealisasi/' . $item->img_terealisasi ?? '') }}"
                                                                                alt="{{ $item->img_terealisasi ?? '' }}"
                                                                                class="img-fluid img-thumbnail"
                                                                                style="max-width: 300px">
                                                                        </a>
                                                                    @endif
                                                                    <div class="input-group">
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                class="custom-file-input"
                                                                                id="img_terealisasi"
                                                                                name="img_terealisasi">
                                                                            <label class="custom-file-label"
                                                                                for="img_terealisasi">Pilih Foto</label>
                                                                        </div>
                                                                    </div>
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
                                            <div class="modal fade" id="hapusPembelanjaan{{ $item->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="hapusPembelanjaanTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Hapus
                                                                Pembelanjaan
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
                                                            <a href="{{ route('pembelanjaan.destroy', $item->id) }}"
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
        <div class="modal fade" id="addPembelanjaan" tabindex="-1" role="dialog"
            aria-labelledby="addPembelanjaanTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pembelanjaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pembelanjaan.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tgl_transaksi" class="col-form-label">Tanggal Transkasi</label>
                                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi">
                            </div>
                            <div class="form-group">
                                <label for="uraian" class="col-form-label">Uraian</label>
                                <textarea name="uraian" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="saldo_awal" class="col-form-label">Bidang</label>
                                <select class="custom-select" name="anggaran_id">
                                    <option selected hidden>--- Pilih ---</option>
                                    @foreach ($anggarans as $bidang)
                                        <option value="{{ $bidang->id }}">
                                            {{ $bidang->bidang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="saldo_awal" class="col-form-label">Sumber Dana</label>
                                <select class="custom-select" name="pendapatan_id">
                                    <option selected hidden>--- Pilih ---</option>
                                    @foreach ($pendapatans as $pendapatan)
                                        <option value="{{ $pendapatan->id }}">
                                            {{ $pendapatan->sumber_dana }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_anggaran" class="col-form-label">Jumlah Anggaran</label>
                                <input type="number" class="form-control" id="jumlah_anggaran" name="jumlah_anggaran"
                                    min="0" step="0.01">
                            </div>

                            <div class="mb-3">
                                <label for="img_transaksi" class="col-form-label">Bukti Transaksi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="img_transaksi"
                                            name="img_transaksi">
                                        <label class="custom-file-label" for="img_transaksi">Pilih Foto</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="img_terealisasi" class="col-form-label">Bukti Terealisasi (opsional)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="img_terealisasi"
                                            name="img_terealisasi">
                                        <label class="custom-file-label" for="img_terealisasi">Pilih Foto</label>
                                    </div>
                                </div>
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
