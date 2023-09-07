@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Dashboard</div>
                </div>
            </div>
            <div class="row">
                
                {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Alat</h4>
                            </div>
                            <div class="card-body">
                                {{ $jumlahAlat }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Bahan</h4>
                            </div>
                            <div class="card-body">
                                {{ $jumlahBahan }}
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                {{ $jumlahPeminjaman }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Penggunaan</h4>
                            </div>
                            <div class="card-body">
                                {{ $jumlahPenggunaan }}
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="row">

                @if (Auth::user()->role == 'Kepala Jurusan' || Auth::user()->role == 'Laboran')
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $dataDetailChart->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $dataPeminjamanPenggunaanChart->container() !!}
                            </div>
                        </div>
                    </div>    
                @endif
                
                
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $dataPeminjamanChart->container() !!}
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $dataPenggunaanChart->container() !!}
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6 col-md-6 col-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reminder Peminjaman</h4>
                            {{-- <div class="card-header-action">
                                <a href="/activities" class="btn btn-primary">Stok Alat</a>
                            </div> --}}
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Aktor</th>
                                            <th>Kegiatan</th>
                                            <th>Batas Peminjaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPeminjamanTerdekat as $show)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{-- <a href="#" class="font-weight-600"><img
                                                        src="assets/img/avatar/avatar-1.png" alt="avatar"
                                                        width="30" class="rounded-circle mr-1"> {{ $show->user_id }}</a> --}}
                                                {{ $show->dataUser->nama }}
                                            </td>
                                            <td>
                                                <strong>{{$show->kegiatan}}</strong>
                                                <br>
                                                {{$show->tujuan}}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($show->tgl_pengembalian)->diff(\Carbon\Carbon::now())->d }} hari lagi
                                                <br>
                                                {{-- {{ $show->tgl_pengembalian }} --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Peminjaman Melewati Batas</h4>
                            {{-- <div class="card-header-action">
                                <a href="/activities" class="btn btn-primary">Stok Alat</a>
                            </div> --}}
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Aktor</th>
                                            <th>Kegiatan</th>
                                            <th>Melewati Batas Peminjaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPeminjamanTelat as $show)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{-- <a href="#" class="font-weight-600"><img
                                                        src="assets/img/avatar/avatar-1.png" alt="avatar"
                                                        width="30" class="rounded-circle mr-1"> {{ $show->user_id }}</a> --}}
                                                {{ $show->dataUser->nama }}
                                            </td>
                                            <td>
                                                <strong>{{$show->kegiatan}}</strong>
                                                <br>
                                                {{$show->tujuan}}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($show->tgl_pengembalian)->diff(\Carbon\Carbon::now())->d }} hari
                                                <br>
                                                {{-- {{ $show->tgl_pengembalian }} --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if (Auth::user()->role == 'Kepala Jurusan' || Auth::user()->role == 'Laboran')
                <div class="col-lg-6 col-md-6 col-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reminder Stok Alat</h4>
                            <div class="card-header-action">
                                {{-- <a href="/activities" class="btn btn-primary">Stok Alat</a> --}}
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Sisa Stok</th>
                                            {{-- <th>Dipinjam</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataAlat as $show)
                                            @if ($show->stok >= 5 && ($show->stok-$show->tersedia) <= 5)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $show->nama }}</td>
                                                    <td>{{ $show->stok - $show->dipinjam}} {{ $show->satuan }}</td>
                                                    {{-- <td>{{ $show->stok - $show->dipinjam }}</td> --}}
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reminder Stok Bahan</h4>
                            <div class="card-header-action">
                                {{-- <a href="/activities" class="btn btn-primary">Stok Alat</a> --}}
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            {{-- <th>Stok</th>
                                            <th>Dipinjam</th> --}}
                                            <th>Sisa Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataBahan as $show)
                                            @if ($show->stok >= 10 && ($show->stok-$show->digunakan) <= 10)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $show->nama }}</td>
                                                    {{-- <td>{{ $show->stok }} {{ $show->satuan }}</td>
                                                    <td>{{ $show->digunakan }} {{ $show->satuan }}</td> --}}
                                                    <td>{{ $show->stok - $show->digunakan }} {{ $show->satuan }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Activities</h4>
                            <div class="card-header-action">
                                <a href="/activities" class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Aktor</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Dibuat pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataLog as $show)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{-- <a href="#" class="font-weight-600"><img
                                                        src="assets/img/avatar/avatar-1.png" alt="avatar"
                                                        width="30" class="rounded-circle mr-1"> {{ $show->user_id }}</a> --}}
                                                {{ $show->dataUser->nama }}
                                            </td>
                                            <td>
                                                {{$show->category}}
                                            </td>
                                            <td>
                                                <?= $show->description ?>
                                            </td>
                                            <td>
                                                {{$show->created_at}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <script src="{{ $dataPeminjamanChart->cdn() }}"></script>

    {{ $dataPeminjamanChart->script() }}
    
    <script src="{{ $dataPeminjamanPenggunaanChart->cdn() }}"></script>

    {{ $dataPeminjamanPenggunaanChart->script() }}
    
    <script src="{{ $dataPenggunaanChart->cdn() }}"></script>

    {{ $dataPenggunaanChart->script() }}
    
    <script src="{{ $dataDetailChart->cdn() }}"></script>

    {{ $dataDetailChart->script() }}
@endsection
