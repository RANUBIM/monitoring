@extends('template.template')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Peminjaman</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Advanced Forms</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Advanced Forms</h2>
                <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p> --}}

                {{-- DATA DETAIL PEMINJAMAN --}}
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Data Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                {{-- @foreach ($datas as $key => $data) --}}
                                <form class="forms-sample" action="/peminjaman/{{ $datas->uuid }}" method="POST">
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
                                        <input type="text" name="peminjam_id"
                                            class="form-control @error('peminjam_id') is-invalid @enderror" id="peminjam_id"
                                            placeholder="peminjam_id" autofocus
                                            value="{{ old('peminjam_id', $datas->dataUser->nama) }}" readonly>
                                        @error('user_id')
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
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="tgl_peminjaman">Tanggal Peminjaman</label>
                                            <input type="date" name="tgl_peminjaman"
                                                class="form-control @error('tgl_peminjaman') is-invalid @enderror"
                                                id="tgl_peminjaman" placeholder="tgl_peminjaman" autofocus
                                                value="{{ old('tgl_peminjaman', $datas->tgl_peminjaman->format('Y-m-d')) }}" readonly>
                                            @error('tgl_peminjaman')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="tgl_pengembalian">Tanggal Pengembalian</label>
                                            <input type="date" name="tgl_pengembalian"
                                                class="form-control @error('tgl_pengembalian') is-invalid @enderror"
                                                id="tgl_pengembalian" placeholder="tgl_pengembalian" autofocus
                                                value="{{ old('tgl_pengembalian', $datas->tgl_pengembalian->format('Y-m-d')) }}" readonly>
                                            @error('tgl_pengembalian')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @if ( $datas->status == "7" )
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="kondisi_peminjaman">Kondisi Peminjaman</label>
                                                <textarea type="text" name="kondisi_peminjaman" class="form-control @error('kondisi_peminjaman') is-invalid @enderror" id="kondisi_peminjaman"
                                                    placeholder="kondisi_peminjaman" autofocus value="" readonly>{{ old('kondisi_peminjaman', $datas->kondisi_peminjaman) }}</textarea>
                                                @error('kondisi_peminjaman')
                                                    <div class="invalid-feedback">
                                                        {{-- {{ $message }} --}}
                                                        "Harap mengisi tujuan kegiatan"
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="kondisi_pengembalian">Kondisi Pengembalian</label>
                                                <textarea type="text" name="kondisi_pengembalian" class="form-control @error('kondisi_pengembalian') is-invalid @enderror" id="kondisi_pengembalian"
                                                    placeholder="kondisi_pengembalian" autofocus value="" readonly>{{ old('kondisi_pengembalian', $datas->kondisi_pengembalian) }}</textarea>
                                                @error('kondisi_pengembalian')
                                                    <div class="invalid-feedback">
                                                        {{-- {{ $message }} --}}
                                                        "Harap mengisi tujuan kegiatan"
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                    @endif
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
                                </form>
                                {{-- @endforeach --}}
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
                                @if ( $datas->status == "7")
                                @else
                                    <a href="/detail-peminjamanAlat/{{ $datas->uuid }}" class="btn btn-primary"><i
                                        class="fa fa-redo"></i></a>
                                @endif

                                @if ( $datas->status == "1")
                                    @if (Auth::user()->nama == $datas->dataUser->nama)
                                        <a href="/create-peminjamanAlat/{{ $datas->uuid }}" class="btn btn-primary ">Tambah</a>
                                    @endif
                                @elseif ( $datas->status == "2")
                                    {{-- output_if --}}
                                @elseif ( $datas->status == "3")
                                    {{-- output_if --}}
                                @elseif ( $datas->status == "4")
                                    {{-- output_if --}}
                                @elseif ( $datas->status == "5")
                                    {{-- output_if --}}
                                @elseif ( $datas->status == "6")
                                    {{-- output_if --}}
                                @elseif ( $datas->status == "7")
                                    {{-- output_if --}}
                                @else
                                    {{-- output_if --}}
                                @endif
                            </div>
                            <div class="card-body">
                                {{-- <div class="section-title mt-0">Light</div> --}}
                                <table class="table table-hover table-responsive-lg table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Labor</th>
                                            <th scope="col">Nama Alat</th>
                                            <th scope="col">Jumlah</th>
                                            @if ( $datas->status == "7")
                                            @else
                                            <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($datas as $data) --}}
                                        @foreach ($datas->dataAlat as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-left">{{ $item->dataLabor->nama }}</td>
                                                <td class="text-left">{{ $item->nama }}</td>
                                                <td>{{ $item->pivot->jumlah }} {{ $item->satuan }}</td>
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
                                                @if ( $datas->status == "7")
                                                @else
                                                    <td>
                                                        {{-- <a href="/edit-peminjamanAlat/{{ $item->pivot->uuid }}"
                                                            class="btn btn-primary">Edit</a> --}}
                                                        @if ( $datas->status == "1")
                                                            <form action="/edit-peminjamanAlat/{{ $item->pivot->uuid }}"
                                                                method="POST" class="d-inline">
                                                                @method('GET')
                                                                @csrf
                                                                <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}">
                                                                <input type="hidden" name="namaAlat" value="{{ $item->nama }}">
                                                                <input type="hidden" name="uuid"
                                                                    value="{{ $datas->uuid }}">
                                                                <input type="hidden" name="uuidAlat"
                                                                    value="{{ $item->uuid }}">
                                                                <input type="hidden" name="uuidPivot"
                                                                    value="{{ $item->pivot->uuid }}">
                                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                            </form>

                                                            @if (Auth::user()->nama == $datas->dataUser->nama)
                                                            <form action="/destroy-peminjamanAlat/{{ $item->pivot->uuid }}"
                                                                method="POST" class="d-inline">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input type="hidden" name="namaAlat" value="{{ $item->nama }}">
                                                                <input type="hidden" name="uuid"
                                                                    value="{{ $datas->uuid }}">
                                                                <input type="hidden" name="uuidAlat"
                                                                    value="{{ $item->uuid }}">
                                                                <input type="hidden" name="uuidPivot"
                                                                    value="{{ $item->pivot->uuid }}">
                                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                                            </form>
                                                            @endif
                                                        @elseif ( $datas->status == "2")
                                                            @if (Auth::user()->role == "Kepala Jurusan" || Auth::user()->role == "Laboran")
                                                                <form action="/edit-peminjamanAlat/{{ $item->pivot->uuid }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('GET')
                                                                    @csrf
                                                                    <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}">
                                                                    <input type="hidden" name="namaAlat" value="{{ $item->nama }}">
                                                                    <input type="hidden" name="uuid"
                                                                        value="{{ $datas->uuid }}">
                                                                    <input type="hidden" name="uuidAlat"
                                                                        value="{{ $item->uuid }}">
                                                                    <input type="hidden" name="uuidPivot"
                                                                        value="{{ $item->pivot->uuid }}">
                                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                                </form>
                                                            @endif
                                                        @elseif ( $datas->status == "3")
                                                            @if (Auth::user()->role == "Kepala Jurusan" && $item->pivot->status == "0")
                                                                <form action="/check-peminjamanAlat/{{ $item->pivot->uuid }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('GET')
                                                                    @csrf
                                                                    <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}">
                                                                    <input type="hidden" name="namaAlat" value="{{ $item->nama }}">
                                                                    <input type="hidden" name="uuid"
                                                                        value="{{ $datas->uuid }}">
                                                                    <input type="hidden" name="uuidAlat"
                                                                        value="{{ $item->uuid }}">
                                                                    <input type="hidden" name="uuidPivot"
                                                                        value="{{ $item->pivot->uuid }}">
                                                                    <button type="submit" class="btn btn-primary">Check</button>
                                                                </form>
                                                            @elseif ($item->pivot->status == "1")
                                                                <button class="btn btn-success">Checked!</button>
                                                            @endif
                                                            {{-- @foreach ($datas->dataAlat as $items)
                                                                {{ $items->nama }}
                                                            @endforeach --}}
                                                        @elseif ( $datas->status == "4")
                                                            {{-- output_if --}}
                                                        @elseif ( $datas->status == "5")
                                                            {{-- output_if --}}
                                                        @elseif ( $datas->status == "6")
                                                            @if ($item->pivot->status == "1")
                                                                <form action="/check-pengembalianAlat/{{ $item->pivot->uuid }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('GET')
                                                                    @csrf
                                                                    <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}">
                                                                    <input type="hidden" name="namaAlat" value="{{ $item->nama }}">
                                                                    <input type="hidden" name="uuid"
                                                                        value="{{ $datas->uuid }}">
                                                                    <input type="hidden" name="uuidAlat"
                                                                        value="{{ $item->uuid }}">
                                                                    <input type="hidden" name="uuidPivot"
                                                                        value="{{ $item->pivot->uuid }}">
                                                                    <button type="submit" class="btn btn-primary">Check</button>
                                                                </form>
                                                            @elseif ($item->pivot->status == "2")
                                                                <button class="btn btn-success">Checked!</button>
                                                            @endif
                                                        @elseif ( $datas->status == "7")
                                                            {{-- output_if --}}
                                                        @else
                                                            {{-- output_if --}}
                                                        @endif
                                                    </td>
                                                @endif
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
                                    {{-- TOMBOL CHANGE STATUS --}}
                                    {{-- {{ $datas->dataAlat as $item }} --}}
                                    @if ( $datas->status == "1")
                                        @if (Auth::user()->nama == $datas->dataUser->nama)
                                            <div class="text-right">
                                                <form action="/status1-peminjamanAlat/{{ $datas->uuid }}"
                                                    method="POST" class="d-inline">
                                                    @method('GET')
                                                    @csrf
                                                    {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                                                    <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                                                    {{-- <input type="hidden" name="uuidAlat" value="{{ $item->uuid }}">
                                                    <input type="hidden" name="uuidPivot" value="{{ $item->pivot->uuid }}"> --}}
                                                    <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                                                </form>
                                                <button class="btn btn-light">Cancel</button>
                                            </div>
                                        @endif
                                    @elseif ( $datas->status == "2")
                                        {{-- Status: Menunggu Persetujuan --}}
                                        @if (Auth::user()->role == "Kepala Jurusan")
                                            <div class="text-right">
                                                <form action="/status2-peminjamanAlat/{{ $datas->uuid }}"
                                                    method="POST" class="d-inline">
                                                    @method('GET')
                                                    @csrf
                                                    {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                                                    <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                                                    {{-- <input type="hidden" name="uuidAlat" value="{{ $item->uuid }}">
                                                    <input type="hidden" name="uuidPivot" value="{{ $item->pivot->uuid }}"> --}}
                                                    <button type="submit" class="btn btn-primary">Terima</button>
                                                </form>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#ModalPenolakan">Tolak</button>
                                            </div>
                                        @endif
                                    @elseif ( $datas->status == "3")
                                    {{-- Status: Menunggu Penyediaan --}}
                                        @if (Auth::user()->role == "Kepala Jurusan")
                                            <div class="text-right">
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#ModalKondisiPeminjaman">Kondisi Peminjaman</button>
                                                <a class="btn btn-secondary" href="/peminjaman">Cancel</a>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <a class="btn btn-secondary" href="/peminjaman">Cancel</a>
                                            </div>
                                        @endif
                                    @elseif ( $datas->status == "4")
                                    {{-- Status: Alat dapat diambil --}}
                                    @elseif ( $datas->status == "5")
                                    {{-- Status: Alat dipinjam --}}
                                    @elseif ( $datas->status == "6")
                                    {{-- Status: Proses pengecekan alat --}}
                                        @if (Auth::user()->role == "Kepala Jurusan")
                                            <div class="text-right">
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#ModalKondisiPengembalian">Kondisi Pengembalian</button>
                                                <a class="btn btn-secondary" href="/peminjaman">Cancel</a>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <a class="btn btn-secondary" href="/peminjaman">Cancel</a>
                                            </div>
                                        @endif
                                    @elseif ( $datas->status == "7")
                                    {{-- Status: Alat dikembalikan --}}
                                        <div class="text-right">
                                            <a class="btn btn-primary" href="/peminjaman">Cancel</a>
                                        </div>
                                    @else
                                    {{-- output_if --}}
                                    @endif
                                    {{-- @endforeach --}}
                                    {{-- TOMBOL CHANGE STATUS --}}
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- /DATA PEMINJAMAN ALAT --}}

            </div>
        </section>
    </div>
    <!-- /Main Content -->
    {{-- MODAL PENOLAKAN PEMINJAMAN --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalPenolakan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/statusTolak-peminjamanAlat/{{ $datas->uuid }}" method="POST" class="d-inline">
                    <div class="modal-body">
                        @method('GET')
                        @csrf
                        {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                        <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                        <label for="status"></label>
                        <textarea class="form-control" name="status" id="status" cols="30" rows="10"></textarea>
                        {{-- <input type="hidden" name="uuidAlat" value="{{ $item->uuid }}">
                        <input type="hidden" name="uuidPivot" value="{{ $item->pivot->uuid }}"> --}}
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /MODAL PENOLAKAN PEMINJAMAN --}}
    
    {{-- MODAL KONDISI PEMINJAMAN ALAT --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalKondisiPeminjaman">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Kondisi Peminjaman Alat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/kondisiPeminjaman-peminjamanAlat/{{ $datas->uuid }}" method="POST" class="d-inline">
                    <div class="modal-body">
                        @method('GET')
                        @csrf
                        {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                        <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                        <label for="kondisi_peminjaman"></label>
                        <textarea class="form-control" name="kondisi_peminjaman" id="kondisi_peminjaman" cols="30" rows="10"></textarea>
                        {{-- <input type="hidden" name="uuidAlat" value="{{ $item->uuid }}">
                        <input type="hidden" name="uuidPivot" value="{{ $item->pivot->uuid }}"> --}}
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /MODAL KONDISI PEMINJAMAN ALAT --}}
    
    {{-- MODAL KONDISI PENGEMBALIAN ALAT --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalKondisiPengembalian">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Kondisi Pengembalian Alat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/kondisiPengembalian-peminjamanAlat/{{ $datas->uuid }}" method="POST" class="d-inline">
                    <div class="modal-body">
                        @method('GET')
                        @csrf
                        {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                        <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                        <label for="kondisi_pengembalian"></label>
                        <textarea class="form-control" name="kondisi_pengembalian" id="kondisi_pengembalian" cols="30" rows="10"></textarea>
                        {{-- <input type="hidden" name="uuidAlat" value="{{ $item->uuid }}">
                        <input type="hidden" name="uuidPivot" value="{{ $item->pivot->uuid }}"> --}}
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /MODAL KONDISI PEMINJAMAN ALAT --}}
@endsection
