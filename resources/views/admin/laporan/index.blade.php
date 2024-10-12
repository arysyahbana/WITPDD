@extends('admin.app')

@section('title', 'Laporan Keuangan')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Laporan Keuangan Dana Desa</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-8">
                        <form action="{{ request()->url() }}" method="GET" class="form-inline mb-4">
                            @csrf
                            <div class="form-group mb-2">
                                <select name="tahun" id="tahun" class="form-control form-control-sm">
                                    <option value="">Lihat Semua Laporan Keuangan</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->year }}"
                                            {{ request('tahun') == $year->year ? 'selected' : '' }}>
                                            Lihat Laporan Keuangan Tahun {{ $year->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mb-2 ml-1"><i class="fas fa-filter"></i>
                                Filter</button>

                            <!-- Tombol Unduh Excel -->
                            @if (!empty(request('tahun')))
                                <a href="{{ route('laporan.export', ['tahun' => request('tahun')]) }}"
                                    class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Excel Tahun
                                    {{ request('tahun') }}
                                </a>
                            @else
                                <a href="{{ route('laporan.export') }}" class="btn btn-sm btn-success mb-2 ml-2">
                                    <i class="fas fa-download"></i> Unduh Semua Excel
                                </a>
                            @endif

                        </form>
                    </div>
                    <div class="col col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Jumlah Pendapatan</th>
                                        <th>Jumlah Pembelanjaan</th>
                                        <th>Surplus/Defisit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->year }}</td>
                                            <td>Rp. {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($item->total_pembelanjaan, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($item->surplus_defisit, 0, ',', '.') }}</td>
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
