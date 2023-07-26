@extends('template.template')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penggunaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Advanced Forms</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Advanced Forms</h2>
                <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p> --}}

                {{-- DATA DETAIL PENGGUNAAN --}}
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Data Penggunaan</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                {{-- @foreach ($datas as $key => $data) --}}
                                <form class="forms-sample" action="/penggunaan/{{ $datas->uuid }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Peminjam</label>
                                        {{-- <select id="user_id"
                                            class="form-control @error('user_id') is-invalid @enderror select2"
                                            name="user_id" style="width: 100%;">
                                            @foreach ($dataUser as $user)
                                                <option value="{{ old('user_id', $datas->user_id) }}"
                                                    @if ($datas->user_id == $user->id) selected="selected" @endif>
                                                    {{ old('user_id', $user->nama) }}
                                                </option>
                                            @endforeach
                                        </select> --}}
                                        <input type="text" name="penggunaan_id"
                                            class="form-control @error('penggunaan_id') is-invalid @enderror" id="penggunaan_id"
                                            placeholder="penggunaan_id" autofocus
                                            value="{{ old('penggunaan_id', $datas->dataUser->nama) }}" readonly>
                                        @error('penggunaan_id')
                                            <div class="invalid-feedback">
                                                {{-- {{ $message }} --}}
                                                Form peminjam wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kegiatan">Kegiatan</label>
                                        <input type="text" name="kegiatan"
                                            class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan"
                                            placeholder="kegiatan" autofocus
                                            value="{{ old('kegiatan', $datas->kegiatan) }}" readonly>
                                        @error('kegiatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan">Tujuan</label>
                                        <textarea type="text" name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" id="tujuan"
                                            placeholder="tujuan" autofocus value="" readonly>{{ old('tujuan', $datas->tujuan) }}</textarea>
                                        @error('tujuan')
                                            <div class="invalid-feedback">
                                                {{-- {{ $message }} --}}
                                                "Harap mengisi tujuan kegiatan"
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" id="status"
                                                placeholder="status" required autofocus value="{{ old('status') }}">
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                    <div class="form-group">
                                        <label for="tgl_permintaan">Tanggal Penggunaan</label>
                                        <input type="date" name="tgl_permintaan"
                                            class="form-control @error('tgl_permintaan') is-invalid @enderror"
                                            id="tgl_permintaan" placeholder="tgl_permintaan" autofocus
                                            value="{{ old('tgl_permintaan', $datas->tgl_permintaan->format('Y-m-d')) }}" readonly>
                                        @error('tgl_permintaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                            <label for="kondisi_peminjaman">Kondisi Peminjaman</label>
                                            <textarea type="text" name="kondisi_peminjaman" class="form-control @error('kondisi_peminjaman') is-invalid @enderror" id="kondisi_peminjaman"
                                                placeholder="kondisi_peminjaman" required autofocus value="{{ old('kondisi_peminjaman') }}"></textarea>
                                            @error('kondisi_peminjaman')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                    {{-- <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button class="btn btn-light">Cancel</button> --}}
                                </form>
                                {{-- @endforeach                               --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /DATA DETAIL PEMINJAMAN --}}

                {{-- DATA PEMINJAMAN ALAT --}}
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="/detail-penggunaan/{{ $datas->uuid }}" class="btn btn-primary"><i
                                        class="fa fa-redo"></i></a>
                                <a href="/create-penggunaanBahan/{{ $datas->uuid }}" class="btn btn-primary ">Tambah</a>
                            </div>
                            <div class="card-body">
                                {{-- <div class="section-title mt-0">Light</div> --}}
                                <table class="table table-hover table-responsive-lg table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Bahan</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($datas as $data) --}}
                                        @foreach ($datas->dataBahan as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->pivot->jumlah }}</td>
                                                {{-- <td>
                                                @foreach ($datas->dataAlat as $item)
                                                {{ $item['nama'] }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($datas->dataAlat as $item)
                                                {{ $item->pivot->jumlah }}
                                                @endforeach
                                            </td> --}}

                                                {{-- Tombol Aksi Button --}}
                                                <td>
                                                    {{-- <a href="/edit-penggunaanBahan/{{ $item->pivot->uuid }}"
                                                        class="btn btn-primary">Edit</a> --}}

                                                    <form action="/edit-penggunaanBahan/{{ $item->pivot->uuid }}"
                                                        method="POST" class="d-inline">
                                                        @method('GET')
                                                        @csrf
                                                        <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}">
                                                        <input type="hidden" name="namaBahan" value="{{ $item->nama }}">
                                                        <input type="hidden" name="uuid"
                                                            value="{{ $datas->uuid }}">
                                                        <input type="hidden" name="uuidBahan"
                                                            value="{{ $item->uuid }}">
                                                        <input type="hidden" name="uuidPivot"
                                                            value="{{ $item->pivot->uuid }}">
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </form>

                                                    <form action="/destroy-penggunaanBahan/{{ $item->pivot->uuid }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="hidden" name="namaBahan" value="{{ $item->nama }}">
                                                        <input type="hidden" name="uuid"
                                                            value="{{ $datas->uuid }}">
                                                        <input type="hidden" name="uuidBahan"
                                                            value="{{ $item->uuid }}">
                                                        <input type="hidden" name="uuidPivot"
                                                            value="{{ $item->pivot->uuid }}">
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </form>
                                                </td>
                                                {{-- /Tombol Aksi Button --}}

                                                {{-- Tombol Aksi Dropdown --}}
                                                {{-- <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Dropdown button
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="/detail-peminjaman/{{ $datas->uuid }}" class="dropdown-item">Detail</a>
                                                    <a href="/peminjaman/{{ $datas->uuid }}/edit" class="dropdown-item">Edit</a>
                                                    
                                                    <form action="/peminjaman/{{ $datas->uuid }}" method="post"
                                                        class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="a dropdown-item"><a>Hapus</a></button>
                                                    </form>
                                                </div>
                                            </div>
                                            </td> --}}
                                                {{-- /Tombol Aksi Dropdown --}}
                                            </tr>
                                        @endforeach
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /DATA PEMINJAMAN ALAT --}}

            </div>
        </section>
    </div>
@endsection
