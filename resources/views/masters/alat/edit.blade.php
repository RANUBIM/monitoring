@extends('template.template')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Alat</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                    <div class="breadcrumb-item"><a href="#">Alat</a></div>
                    <div class="breadcrumb-item">Edit Data Alat</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Advanced Forms</h2>
                <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p> --}}

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Data Alat</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                {{-- @foreach($datas as $key => $data) --}}
                                    <form class="forms-sample" action="/alat/{{ $datas->uuid}}" method="POST">
                                        @method('put')
                                        @csrf
                                        <div class="form-group">
                                            <label>Labor</label>
                                            <select id="labor_id" class="form-control @error('labor_id') is-invalid @enderror select2" name="labor_id" style="width: 100%;" >
                                                @foreach ($dataLabor as $labor)
                                                    <option value="{{ old('labor_id', $datas->labor_id) }}" @if ($datas->labor_id == $labor->id) selected="selected" @endif>
                                                        {{ old('labor_id', $labor->nama) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('labor_id')
                                                <div class="invalid-feedback">
                                                    {{-- {{ $message }} --}}
                                                    Form peminjam wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                placeholder="nama" required autofocus value="{{ old('nama', $datas->nama) }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="spesifikasi">Spesifikasi</label>
                                            <input type="text" name="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror" id="spesifikasi"
                                                placeholder="spesifikasi" required autofocus value="{{ old('spesifikasi', $datas->spesifikasi) }}">
                                            @error('spesifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="stok">Stok</label>
                                                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" id="stok"
                                                    placeholder="stok" required autofocus value="{{ old('stok', $datas->stok) }}">
                                                @error('stok')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" id="satuan"
                                                    placeholder="satuan" required autofocus value="{{ old('satuan', $datas->satuan) }}">
                                                @error('satuan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                                placeholder="keterangan" required autofocus value="">{{ old('keterangan', $datas->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <a href="{{ url('alat') }}" class="btn btn-light">Cancel</a>
                                    </form>  
                                {{-- @endforeach--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
