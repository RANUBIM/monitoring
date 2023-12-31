@extends('template.template')
@section('content')
   <div class="main-content">
      <section class="section">
         <div class="section-header">
               <h1>Labor</h1>
               <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                  <div class="breadcrumb-item"><a href="#">Labor</a></div>
                  <div class="breadcrumb-item">Data Labor</div>
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
                              <a href="/labor" class="btn mdi-bookmark-off-outline btn-primary "><i
                                       class="fa fa-redo"></i></a>
                              <a href="/labor/create" class="btn btn-primary" style="float: right">Tambah</a>
                           </div>
                           <div class="card-body">
                              {{-- <div class="section-title mt-0">Light</div> --}}
                              <table class="table table-hover table-responsive-lg table-bordered text-center" id="example">
                                 <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Nama Labor</th>
                                          {{-- <th scope="col">Data</th> --}}
                                          <th scope="col">Aksi</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                       @foreach ($datas as $data)
                                          <tr>
                                             <th scope="row">{{ $loop->iteration }}</th>
                                             <td class="text-left">{{ $data->nama }}</td>
                                             {{-- <td>
                                                @foreach ($data->dataAlat as $dataAlat)
                                                   {{ $dataAlat['nama'] }} <br>
                                                @endforeach
                                             </td> --}}

                                             {{-- Tombol Aksi Dropdown --}}
                                          <td class="text-right">
                                             <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                   {{-- <a href="/labor/{{ $data->uuid }}" class="dropdown-item">Detail</a> --}}
                                                   <a href="/labor/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>
                                                   
                                                   <form action="/labor/{{ $data->uuid }}" method="post"
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
                                                   <a href="/labor/{{ $data->uuid }}/edit"
                                                      class="btn btn-primary">Edit</a>

                                                   <form action="/labor/{{ $data->uuid }}" method="post"
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
