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
                                    @if ( $datas->status == "5" )
                                        <div class="form-group">
                                            <label for="note">Catatan</label>
                                            <textarea type="text" name="note" class="form-control @error('note') is-invalid @enderror" id="note"
                                                placeholder="note" autofocus value="" readonly>{{ old('note', $datas->note) }}</textarea>
                                            @error('note')
                                                <div class="invalid-feedback">
                                                    {{-- {{ $message }} --}}
                                                    "Harap mengisi tujuan kegiatan"
                                                </div>
                                            @enderror
                                        </div>
                                    @elseif ( $datas->status == "tolak" )
                                        <div class="form-group">
                                            <label for="note">Alasan Penolakan</label>
                                            <textarea type="text" name="note" class="form-control @error('note') is-invalid @enderror" id="note"
                                                placeholder="note" autofocus value="" readonly>{{ old('note', $datas->note) }}</textarea>
                                            @error('note')
                                                <div class="invalid-feedback">
                                                    {{-- {{ $message }} --}}
                                                    "Harap mengisi tujuan kegiatan"
                                                </div>
                                            @enderror
                                        </div>
                                    @else
                                    @endif
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
                            @if ( $datas->status == "5" || $datas->status == "tolak")
                            @else
                                <div class="card-header">
                                    @if ( $datas->status == "5")
                                    @else
                                        <a href="/detail-penggunaanBahan/{{ $datas->uuid }}" class="btn btn-primary"><i
                                            class="fa fa-redo"></i></a>
                                    @endif

                                    @if ( $datas->status == "1")
                                        @if (Auth::user()->nama == $datas->dataUser->nama)
                                            <a href="/create-penggunaanBahan/{{ $datas->uuid }}" class="btn btn-primary ">Tambah</a>
                                        @endif
                                    @elseif ( $datas->status == "2")
                                        {{-- output_if --}}
                                    @elseif ( $datas->status == "3")
                                        {{-- output_if --}}
                                    @elseif ( $datas->status == "4")
                                        {{-- output_if --}}
                                    @elseif ( $datas->status == "5")
                                        {{-- output_if --}}
                                    @else
                                        {{-- output_if --}}
                                    @endif
                                </div>
                            @endif
                            <div class="card-body">
                                {{-- <div class="section-title mt-0">Light</div> --}}
                                <table class="table table-hover table-responsive-lg table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Labor</th>
                                            <th scope="col">Nama Bahan</th>
                                            <th scope="col">Spesifikasi</th>
                                            <th scope="col">Jumlah</th>
                                            @if ( $datas->status == "5")
                                            @else
                                                <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($datas as $data) --}}
                                        @foreach ($datas->dataBahan as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-left">{{ $item->dataLabor->nama }}</td>
                                                <td class="text-left">{{ $item->nama }}</td>
                                                <td class="text-left">{{ $item->spesifikasi }}</td>
                                                <td>{{ $item->pivot->jumlah }} {{ $item->satuan }} </td>
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
                                                @if ( $datas->status == "5")
                                                @else
                                                    <td>
                                                        {{-- <a href="/edit-penggunaanBahan/{{ $item->pivot->uuid }}"
                                                            class="btn btn-primary">Edit</a> --}}
                                                        @if ( $datas->status == "1")
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

                                                            @if (Auth::user()->nama == $datas->dataUser->nama)
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
                                                            @endif
                                                        @elseif ($datas->status == "2")
                                                            @if (Auth::user()->role == "Kepala Jurusan")
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
                                                            @endif
                                                        @elseif ($datas->status == "3")
                                                            {{-- @if (Auth::user()->role == "Kepala Jurusan" && $item->pivot->status == "0")
                                                                <form action="/check-penggunaanBahan/{{ $item->pivot->uuid }}"
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
                                                                    <button type="submit" class="btn btn-primary">Check</button>
                                                                </form>
                                                            @elseif ($item->pivot->status == "1")
                                                                <button class="btn btn-success">Checked!</button>
                                                            @endif --}}
                                                        @elseif ($datas->status == "4")
                                                            
                                                        @else
                                                        
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
                                            <form action="/status1-penggunaanBahan/{{ $datas->uuid }}"
                                                method="POST" class="d-inline">
                                                @method('GET')
                                                @csrf
                                                {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                                                <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                                                {{-- <input type="hidden" name="uuidAlat" value="{{ $item->uuid }}">
                                                <input type="hidden" name="uuidPivot" value="{{ $item->pivot->uuid }}"> --}}
                                                <button type="submit" class="btn btn-primary">Ajukan Penggunaan</button>
                                            </form>
                                            <a class="btn btn-secondary" href="/penggunaan">Cancel</a>
                                        </div>
                                    @else
                                        <div class="text-right">
                                            <a class="btn btn-secondary" href="/penggunaan">Cancel</a>
                                        </div>
                                    @endif
                                @elseif ( $datas->status == "2")
                                    {{-- Status: Menunggu Persetujuan --}}
                                    @if (Auth::user()->role == "Kepala Jurusan")
                                        <div class="text-right">
                                            <form action="/status2-penggunaanBahan/{{ $datas->uuid }}"
                                                method="POST" class="d-inline">
                                                @method('GET')
                                                @csrf
                                                {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                                                <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                                                {{-- <input type="hidden" name="uuidAlat" value="{{ $item->uuid }}">
                                                <input type="hidden" name="uuidPivot" value="{{ $item->pivot->uuid }}"> --}}
                                                <button type="submit" class="btn btn-primary">Terima</button>
                                            </form>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#ModalPenolakan">Tolak</button>
                                            <a class="btn btn-secondary" href="/penggunaan">Cancel</a>
                                        </div>
                                    @else
                                        <div class="text-right">
                                            <a class="btn btn-secondary" href="/penggunaan">Cancel</a>
                                        </div>
                                    @endif
                                @elseif ( $datas->status == "3")
                                {{-- Status: Menunggu Penyediaan --}}
                                    @if (Auth::user()->role == "Kepala Jurusan")
                                        <div class="text-right">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#ModalNote">Konfirmasi Penggunaan</button>
                                            <a class="btn btn-secondary" href="/penggunaan">Cancel</a>
                                        </div>
                                    @else
                                        <div class="text-right">
                                            <a class="btn btn-secondary" href="/penggunaan">Cancel</a>
                                        </div>
                                    @endif
                                @elseif ( $datas->status == "4")
                                {{-- Status: Alat dapat diambil --}}
                                    <div class="text-right">
                                        <a class="btn btn-secondary" href="/penggunaan">Cancel</a>
                                    </div>
                                @elseif ( $datas->status == "5")
                                {{-- Status: Alat dipinjam --}}
                                    <div class="text-right">
                                        <a class="btn btn-primary" href="/penggunaan">Cancel</a>
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
    {{-- MODAL PENOLAKAN PENGGUNAAN --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalPenolakan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Tolak Pengajuan Penggunaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/statusTolak-penggunaanBahan/{{ $datas->uuid }}" method="POST" class="d-inline">
                    <div class="modal-body">
                        @method('GET')
                        @csrf
                        {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                        <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                        <label for="note"></label>
                        <textarea class="form-control" name="note" id="note" cols="30" rows="10"></textarea>
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
    {{-- /MODAL PENOLAKAN PENGGUNAAN --}}
    
    {{-- MODAL KONDISI PENGGUNAAN BAHAN --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalKondisiPeminjaman">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Note Penggunaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/note-penggunaanBahan/{{ $datas->uuid }}" method="POST" class="d-inline">
                    <div class="modal-body">
                        @method('GET')
                        @csrf
                        {{-- <input type="hidden" name="namaAlat" value="{{ $datas->nama }}"> --}}
                        <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                        <label for="note"></label>
                        <textarea class="form-control" name="note" id="note" cols="30" rows="10"></textarea>
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
    {{-- /MODAL KONDISI PENGGUNAAN BAHAN --}}
    
    {{-- MODAL KONDISI PENGGUNAAN BAHAN (KOMPLIT) --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalNote">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Kondisi Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/status3-penggunaanBahan/{{ $datas->uuid }}" method="POST" class="d-inline">
                    <div class="modal-body">
                        @method('GET')
                        @csrf

                        {{-- <form action="/status3-peminjamanAlat/{{ $item->pivot->uuid }}"
                            method="POST" class="d-inline">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-primary">Komplit</button>
                        </form> --}}
                        <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}">
                        <input type="hidden" name="penggunaan_id" value="{{ $datas->id }}">
                        <input type="hidden" name="uuid"
                            value="{{ $datas->uuid }}">
                        {{-- <input type="hidden" name="uuidAlat"
                            value="{{ $item->uuid }}">
                        <input type="hidden" name="uuidPivot"
                            value="{{ $item->pivot->uuid }}"> --}}

                        <label for="note"></label>
                        <textarea class="form-control" name="note" id="note" cols="30" rows="10"></textarea>
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
    {{-- /MODAL KONDISI PENGGUNAAN BAHAN KOMPLIT--}}

@endsection
