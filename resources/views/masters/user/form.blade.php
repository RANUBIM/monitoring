@extends('template.template')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
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
                                <h4>Input Data User</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                <form class="forms-sample" action="/user" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role" id="selectRole" required>
                                            <option value="{{ old('role',"") }}">{{ old('role',"Pilih Role") }}</option>
                                            <option value="Kepala Jurusan">Kepala Jurusan</option>
                                            <option value="Laboran">Laboran</option>
                                            <option value="Guru">Guru</option>
                                            <option value="Siswa">Siswa</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="niknis">NIK / NIS</label>
                                            <input type="number" name="niknis" class="form-control @error('niknis') is-invalid @enderror" id="niknis"
                                                placeholder="niknis" required autofocus value="{{ old('niknis') }}">
                                            @error('niknis')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                                placeholder="password" required autofocus value="{{ old('password') }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                            placeholder="nama" required autofocus value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row" id="inputSiswa">
                                        <div class="form-group col-6">
                                            <label for="kelas">Kelas</label>
                                            <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror"
                                                placeholder="kelas" required autofocus value="{{ old('kelas') }}">
                                            @error('kelas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="jurusan">Jurusan</label>
                                            <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                                                placeholder="jurusan" required autofocus value="{{ old('jurusan') }}">
                                            @error('jurusan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="" id="inputGuru">
                                        <div class="form-group">
                                            <label for="mapel">Mata Pelajaran</label>
                                            <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" id="mapel"
                                                placeholder="mapel" required autofocus value="{{ old('mapel') }}">
                                            @error('mapel')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kontak">Kontak</label>
                                        <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror" id="kontak"
                                            placeholder="kontak" autofocus value="{{ old('kontak') }}">
                                        @error('kontak')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="name">UUID Sementara</label>
                                        <input type="text" name="uuid" class="form-control @error('uuid') is-invalid @enderror" id="uuid"
                                            placeholder="uuid" required autofocus value="{{ old('uuid') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a href="{{ url('user') }}" class="btn btn-light">Cancel</a>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
