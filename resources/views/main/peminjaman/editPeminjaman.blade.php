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

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Data Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                {{-- @foreach ($datas as $key => $data) --}}
                                <form class="forms-sample" action="/update-peminjamanAlat/{{ $datas->uuid }}"
                                    method="POST">
                                    @method('GET')
                                    @csrf
                                    {{-- <input type="text" name="namaLog" value="{{ $datas->alat_id->nama }}"> --}}
                                    <input type="hidden" name="uuid" value="{{ $validatedData['uuid'] }}">
                                    <input type="hidden" name="uuidAlat" value="{{ $validatedData['uuidAlat'] }}">
                                    <input type="hidden" name="uuidPivot" value="{{ $validatedData['uuidPivot'] }}">
                                    {{-- <div class="form-group">
                                        <label>Peminjam</label>
                                        <input type="text" name="peminjaman_id"
                                            class="form-control @error('peminjaman_id') is-invalid @enderror"
                                            id="peminjaman_id" placeholder="peminjaman_id" autofocus
                                            value="{{ $datas->peminjaman_id }}" disabled>
                                        <input type="hidden" name="peminjamanan_id"
                                            class="form-control @error('peminjaman_id') is-invalid @enderror"
                                            id="peminjaman_id" placeholder="peminjamanan_id" autofocus
                                            value="{{ $datas->peminjaman_id }}">
                                        <div class="form-group">
                                            <label>Peminjam</label>
                                            <select id="peminjaman_id" class="form-control @error('peminjaman_id') is-invalid @enderror select2" name="peminjaman_id" style="width: 100%;" >
                                                
                                                @foreach ($datass->dataUser as $user)
                                                    <option value="{{ old('peminjaman_id', $user->dataUser->id) }}" @if ($user->dataUser->id == $user->id) selected="selected" @endif>
                                                        {{ old('peminjaman_id', $user->nama) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('peminjaman_id')
                                                <div class="invalid-feedback">
                                                        {{ $message }} 
                                                    Form peminjam wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    {{-- <input type="text" name="alat_id" id="alat_id" value="{{ $datas->alat_id }}"> --}}
                                    <div class="form-group">
                                        <label>Alat</label>
                                        <select id="alat_id" class="form-control @error('alat_id') is-invalid @enderror select2" name="alat_id" style="width: 100%;" >
                                            
                                            @foreach ($dataAlat as $alat)
                                                <option value="{{ old('alat_id', $alat->id) }}" @if ($alat->id == $datas->alat_id) selected="selected" @endif>
                                                    {{ old('alat_id', $alat->dataLabor->nama) }} - {{ old('alat_id', $alat->nama) }} <strong>[ {{ old('alat_id', $alat->stok-$alat->dipinjam) }} ]</strong>
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('alat_id')
                                            <div class="invalid-feedback">
                                                    {{ $message }} 
                                                Form peminjam wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Alat</label>
                                        <select id="alat_id"
                                            class="form-control @error('alat_id') is-invalid @enderror select2"
                                            name="alat_id" style="width: 100%;">
                                            @foreach ($dataAlat as $alat)
                                                <option value="{{ old('alat_id', $datas->alat_id) }}">
                                                    {{ old('alat_id', $alat->nama) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        //<input type="text" name="alat_id" id="alat_id" value="{{ $datas->alat_id }}"> 
                                        @error('alat_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="text" name="jumlah"
                                            class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                            placeholder="jumlah" autofocus value="{{ old('jumlah', $datas->jumlah) }}">
                                        @error('jumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
