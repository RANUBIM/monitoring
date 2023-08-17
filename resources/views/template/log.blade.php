@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Activities</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Activities</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                            {{-- <div class="card-header">
                                <h4>Activities</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary">View All</a>
                                </div>
                            </div> --}}
                            <div class="card-body">
                                {{-- <div class="section-title mt-0">Light</div> --}}
                                <table class="table table-hover table-responsive-lg table-bordered" id="example">
                                <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th>Aktor</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Dibuat pada</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataLog as $data)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $data->dataUser->nama }}</td>
                                            <td>{{ $data->category }}</td>
                                            <td><?= $data->description ?></td>
                                            <td>{{ $data->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
