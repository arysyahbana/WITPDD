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
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Kritik</th>
                                        <th class="text-center">Saran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($krisar as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at ?? '')->locale('id')->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ $item->nama ?? '' }}</td>
                                            <td>{{ $item->email ?? '' }}</td>
                                            <td style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                                {{ $item->kritik ?? '' }}</td>
                                            <td style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                                {{ $item->saran ?? '' }}</td>
                                        </tr>
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
