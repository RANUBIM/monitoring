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
                                <h4>Input Data Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                <form class="forms-sample" action="/store-peminjamanAlat" method="GET">
                                    @csrf
                                    <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                                    <div class="form-group">
                                        <label>Peminjaman</label>
                                        {{-- <p>{{ $datas->uuid }}</p><br> --}}
                                        {{-- <p>{{ $datas->dataUser->nama }}</p> --}}
                                        <input type="text" name="peminjaman_id"
                                            class="form-control @error('peminjaman_id') is-invalid @enderror"
                                            id="peminjaman_id" placeholder="peminjaman_id" autofocus
                                            value="{{ $datas->dataUser->nama }}" readonly>
                                        <input type="hidden" name="peminjaman_id"
                                            class="form-control @error('peminjaman_id') is-invalid @enderror"
                                            id="peminjaman_id" placeholder="peminjaman_id" autofocus
                                            value="{{ $datas->id }}">
                                        {{-- <select id="peminjaman_id" class="form-control @error('peminjaman_id') is-invalid @enderror " name="peminjaman_id" style="width: 100%;" readonly>
                                            <option selected="selected" value="{{ $datas->id }}">{{ $datas->dataUser->nama }}</option>
                                            @foreach ($dataUsers as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->nama }}
                                                </option>
                                            @endforeach
                                        </select> --}}
                                        @error('peminjaman_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror 
                                    </div>
                                    <div class="form-group">
                                        <label>Alat</label>
                                        <select id="alat_id"
                                            class="form-control @error('alat_id') is-invalid @enderror select2"
                                            name="alat_id" style="width: 100%;" required>
                                            <option selected="selected" value="">Input Alat</option>
                                            @foreach ($dataAlat as $alat)
                                                <option value="{{ $alat->id }}">
                                                    {{ $alat->dataLabor->nama }} - {{ $alat->nama }} [ {{ $alat->stok-$alat->dipinjam }} ]
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('alat_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="text" name="jumlah"
                                            class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                            placeholder="jumlah" autofocus value="{{ old('jumlah') }}">
                                        @error('jumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
