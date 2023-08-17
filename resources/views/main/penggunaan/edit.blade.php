@extends('template.template')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penggunaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Main Data</a></div>
                    <div class="breadcrumb-item"><a href="#">Penggunaaan</a></div>
                    <div class="breadcrumb-item">Edit Data Penggunaaan</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Advanced Forms</h2>
                <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p> --}}

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Data Penggunaan</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                {{-- @foreach($datas as $key => $data) --}}
                                    <form class="forms-sample" action="/penggunaan/{{ $datas->uuid}}" method="POST">
                                        @method('put')
                                        @csrf
                                        <div class="form-group">
                                            <label>Peminjam</label>
                                            {{-- <select id="user_id" class="form-control @error('user_id') is-invalid @enderror select2" name="user_id" style="width: 100%;" >
                                                
                                                @foreach ($dataUser as $user)
                                                    <option value="{{ old('user_id', $datas->user_id) }}" @if ($datas->user_id == $user->id) selected="selected" @endif>
                                                        {{ old('user_id', $user->nama) }}
                                                    </option>
                                                @endforeach
                                            </select> --}}
                                            <input type="hidden" name="user_id"
                                                class="form-control @error('user_id') is-invalid @enderror" id="user_id"
                                                placeholder="user_id" autofocus value="{{ $datas->dataUser->id }}">
                                            <input type="text" name="user_id"
                                                class="form-control @error('user_id') is-invalid @enderror" id="user_id"
                                                placeholder="user_id" autofocus value="{{ $datas->dataUser->nama }}" disabled>
                                            @error('user_id')
                                                <div class="invalid-feedback">
                                                    {{-- {{ $message }} --}}
                                                    Form peminjam wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kegiatan">Kegiatan</label>
                                            <input type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan"
                                                placeholder="kegiatan"  autofocus value="{{ old('kegiatan', $datas->kegiatan) }}">
                                            @error('kegiatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tujuan">Tujuan</label>
                                            <textarea type="text" name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" id="tujuan"
                                                placeholder="tujuan" autofocus value="">{{ old('tujuan', $datas->tujuan) }}</textarea>
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
                                            <label for="tgl_permintaan">Tanggal Permintaan</label>
                                            <input type="date" name="tgl_permintaan" class="form-control @error('tgl_permintaan') is-invalid @enderror" id="tgl_permintaan"
                                                placeholder="tgl_permintaan" autofocus value="{{ old('tgl_permintaan', $datas->tgl_permintaan->format('Y-m-d')) }}">
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
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
                                    </form>  
                                {{-- @endforeach                               --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
