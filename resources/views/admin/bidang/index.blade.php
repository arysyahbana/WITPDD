@extends('admin.app')

@section('title', 'Bidang')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Bidang</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-lg-8">
                        <div class="my-3">
                            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addBidang"><i
                                    class="fas fa-plus fa-cog"></i> Tambah</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>No</th>
                                        <th>Nama Bidang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bidang as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->bidang ?? '' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#editBidang{{ $item->id }}"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#hapusBidang{{ $item->id }}"><i
                                                        class="fa fa-trash-alt"></i>
                                                    Hapus</a>
                                            </td>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editBidang{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editBidangTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Bidang
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('bidang.update', $item->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Nama
                                                                        Bidang</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="bidang"
                                                                        value="{{ $item->bidang ?? '' }}">
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
                                            <div class="modal fade" id="hapusBidang{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="hapusBidangTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Hapus Bidang
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
                                                            <a href="{{ route('bidang.destroy', $item->id) }}"
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
        <div class="modal fade" id="addBidang" tabindex="-1" role="dialog" aria-labelledby="addBidangTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Bidang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('bidang.store') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama Bidang</label>
                                <input type="text" class="form-control" id="name" name="bidang">
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
