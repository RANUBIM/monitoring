@extends('template.template')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                    <div class="breadcrumb-item"><a href="#">Labor</a></div>
                    <div class="breadcrumb-item">Tambah Data Labor</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Advanced Forms</h2>
                <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p> --}}

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Input Data Labor</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label>Default Input Text</label>
                                    <input type="text" class="form-control">
                                </div> --}}
                                <form class="forms-sample" action="/labor" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama Labor</label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                            placeholder="nama" required autofocus value="{{ old('nama') }}">
                                        @error('nama')
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
                                    <a href="{{ url('labor') }}" class="btn btn-light">Cancel</a>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
