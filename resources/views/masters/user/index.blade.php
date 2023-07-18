@extends('template.template')
@section('content')
   <div class="main-content">
      <section class="section">
         <div class="section-header">
               <h1>User</h1>
               <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                  <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                  <div class="breadcrumb-item">Table</div>
               </div>
         </div>

         {{-- Notif --}}
         @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible show fade">
               <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                     <span>&times;</span>
                  </button>
                  {{ session('success') }}
               </div>
            </div>
         @endif
         @if (session()->has('delete'))
            <div class="alert alert-danger alert-dismissible show fade">
               <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                     <span>&times;</span>
                  </button>
                  {{ session('delete') }}
               </div>
            </div>
         @endif
         {{-- /Notif --}}
         
         <div class="section-body">
               {{-- <h2 class="section-title">Tables</h2>
               <p class="section-lead">
                  Examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap.
               </p> --}}

               <div class="row">
                  <div class="col-12 col-md-12 col-lg-12">
                     <div class="card">
                           <div class="card-header">
                              <a href="/user" class="btn btn-primary"><i class="fa fa-redo"></i></a>
                              <a href="/user/create" class="btn btn-primary ">Tambah</a>
                           </div>
                           <div class="card-body">
                              {{-- <div class="section-title mt-0">Light</div> --}}
                              <table class="table table-hover table-responsive-lg table-bordered">
                                 <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">NIK/NIS</th>
                                          <th scope="col">Nama</th>
                                          <th scope="col">Role</th>
                                          <th scope="col">Kelas</th>
                                          <th scope="col">Jurusan</th>
                                          <th scope="col">Mata Pelajaran</th>
                                          <th scope="col">Kontak</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($datas as $data)
                                       <tr>
                                          <th scope="row">{{ $loop->iteration }}</th>
                                          <td>{{ $data->niknis }}</td>
                                          <td>{{ $data->nama }}</td>
                                          <td>{{ $data->role }}</td>
                                          <td>{{ $data->kelas }}</td>
                                          <td>{{ $data->jurusan }}</td>
                                          <td>{{ $data->mapel }}</td>
                                          <td>{{ $data->kontak }}</td>
                                          {{-- Tombol Aksi Dropdown --}}
                                          <td>
                                             <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                   <a href="/user/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                   <a href="/user/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>
                                                   
                                                   <form action="/user/{{ $data->uuid }}" method="post"
                                                      class="d-inline">
                                                      @method('delete')
                                                      @csrf
                                                      <button type="submit" class="a dropdown-item"><a>Hapus</a></button>
                                                   </form>
                                                </div>
                                             </div>
                                          </td>
                                          {{-- /Tombol Aksi Dropdown --}}

                                          {{-- <td>
                                             <a href="/user/{{ $data->uuid }}/edit" class="btn btn-primary">Edit</a>

                                             <form action="/user/{{ $data->uuid }}" method="post"
                                                   class="d-inline">
                                                   @method('delete')
                                                   @csrf
                                                   <button type="submit" class="btn btn-primary">Hapus</button>
                                             </form>
                                          </td> --}}
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