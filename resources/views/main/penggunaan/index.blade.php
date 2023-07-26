@extends('template.template')
@section('content')
   <div class="main-content">
      <section class="section">
         <div class="section-header">
               <h1>Penggunaan</h1>
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
                              <a href="/penggunaan" class="btn btn-primary"><i class="fa fa-redo"></i></a>
                              <a href="/penggunaan/create" class="btn btn-primary ">Tambah</a>
                           </div>
                           <div class="card-body">
                              {{-- <div class="section-title mt-0">Light</div> --}}
                              <table class="table table-hover table-responsive-lg table-bordered">
                                 <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Peminjam</th>
                                          <th scope="col">Kegiatan</th>
                                          <th scope="col">Tujuan</th>
                                          <th scope="col">Tanggal Permintaan</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Aksi</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($datas as $data)
                                       <tr>
                                          <th scope="row">{{ $loop->iteration }}</th>
                                          <td>{{ $data->dataUser['nama'] }}</td>
                                          <td>{{ $data->kegiatan }}</td>
                                          <td>{{ $data->tujuan }}</td>
                                          <td>{{ $data->tgl_permintaan->isoFormat("D MMMM Y") }}</td>
                                          <td>{{ $data->status }}</td>
                                          
                                          {{-- Tombol Aksi Button --}}
                                          {{-- <td >
                                             <a href="/detail-peminjaman/{{ $data->uuid }}" class="btn btn-primary">Detail</a>
                                             <a href="/peminjaman/{{ $data->uuid }}/edit" class="btn btn-primary">Edit</a>
                                             
                                             <form action="/peminjaman/{{ $data->uuid }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-primary"><a class=""></a>Hapus</button>
                                             </form>
                                          </td> --}}
                                          {{-- /Tombol Aksi Button --}}
                                          
                                          {{-- Tombol Aksi Dropdown --}}
                                          <td>
                                             <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                   <a href="/detail-penggunaanBahan/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                   <a href="/penggunaan/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>
                                                   
                                                   <form action="/penggunaan/{{ $data->uuid }}" method="post"
                                                      class="d-inline">
                                                      @method('delete')
                                                      @csrf
                                                      <button type="submit" class="a dropdown-item"><a>Hapus</a></button>
                                                   </form>
                                                </div>
                                             </div>
                                          </td>
                                          {{-- /Tombol Aksi Dropdown --}}
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