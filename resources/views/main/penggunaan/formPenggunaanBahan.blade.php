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

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Input Data Penggunaan</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                <form class="forms-sample" action="/store-penggunaanBahan" method="GET">
                                    @csrf
                                    <input type="hidden" name="uuid" value="{{ $datas->uuid }}">
                                    <div class="form-group">
                                        <label>Pengguna</label>
                                        {{-- <p>{{ $datas->uuid }}</p><br> --}}
                                        {{-- <p>{{ $datas->dataUser->nama }}</p> --}}
                                        <input type="text" name="penggunaan_id"
                                            class="form-control @error('penggunaan_id') is-invalid @enderror"
                                            id="penggunaan_id" placeholder="penggunaan_id" autofocus
                                            value="{{ $datas->dataUser->nama }}" disabled>
                                        <input type="hidden" name="penggunaan_id"
                                            class="form-control @error('penggunaan_id') is-invalid @enderror"
                                            id="penggunaan_id" placeholder="penggunaan_id" autofocus
                                            value="{{ $datas->id }}">
                                        {{-- <select id="peminjaman_id" class="form-control @error('peminjaman_id') is-invalid @enderror select2" name="peminjaman_id" style="width: 100%;" >
                                            <option selected="selected" value="">Input Peminjam</option>
                                            @foreach ($datas as $data)
                                                <option value="{{ $data->dataUser->id }}">
                                                    {{ $data->dataUser->nama }}
                                                </option>
                                            @endforeach
                                        </select>--}}
                                        @error('penggunaan_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror 
                                    </div>
                                    <div class="form-group">
                                        <label>Bahan</label>
                                        <select id="bahan_id"
                                            class="form-control @error('bahan_id') is-invalid @enderror select2"
                                            name="bahan_id" style="width: 100%;">
                                            <option selected="selected" value="">Input Bahan</option>
                                            @foreach ($dataBahan as $bahan)
                                                <option value="{{ $bahan->id }}">
                                                    {{ $bahan->dataLabor->nama }} - {{ $bahan->nama }} [ {{ $bahan->stok-$bahan->digunakan }} ]
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bahan_id')
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
