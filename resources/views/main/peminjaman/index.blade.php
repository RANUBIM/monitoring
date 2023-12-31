@extends('template.template')
@section('content')
   <div class="main-content">
      <section class="section">
         <div class="section-header">
               <h1>Peminjaman</h1>
               <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="#">Main Data</a></div>
                  <div class="breadcrumb-item">Peminjaman</div>
               </div>
         </div>

         {{-- Filter --}}
         <div class=" mb-2 ">            
            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="">
               <button type="submit" class="btn btn-behance"><a>All</a></button>
            </form>
            
            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="1">
               <button type="submit" class="btn btn-behance"><a>Belum diajukan</a></button>
            </form>
            
            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="2">
               <button type="submit" class="btn "><a>Persetujuan</a></button>
            </form>

            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="3">
               <button type="submit" class="btn "><a>Penyediaan</a></button>
            </form>

            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="4">
               <button type="submit" class="btn "><a>Dapat Diambil</a></button>
            </form>

            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="5">
               <button type="submit" class="btn "><a>Dipinjam</a></button>
            </form>
            
            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="6">
               <button type="submit" class="btn "><a>Persetujuan</a></button>
            </form>

            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="7">
               <button type="submit" class="btn "><a>Pengecekan</a></button>
            </form>

            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="8">
               <button type="submit" class="btn "><a>Dikembalikan</a></button>
            </form>
            
            <form action="/peminjaman/" method="post"
               class="d-inline">
               @method('get')
               @csrf
               <input type="hidden" name="filter" value="tolak">
               <button type="submit" class="btn "><a>Ditolak</a></button>
            </form>
         </div>
         {{-- /Filter --}}
         
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
                              <a href="/peminjaman" class="btn btn-primary"><i class="fa fa-redo"></i></a>
                              <a href="/peminjaman/create" class="btn btn-primary ">Tambah</a>
                           </div>
                           <div class="card-body">
                              {{-- <div class="section-title mt-0">Light</div> --}}
                              <table class="table table-hover table-responsive-lg table-bordered" id="example">
                                 <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Peminjam</th>
                                          <th scope="col">Kegiatan</th>
                                          {{-- <th scope="col">Tujuan</th> --}}
                                          <th scope="col">Tanggal Peminjaman/Pengembalian</th>
                                          {{-- <th scope="col">Kondisi</th> --}}
                                          <th scope="col">Status</th>
                                          {{-- <th scope="col">Alat</th> --}}
                                          <th scope="col">Aksi</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($datas as $data)
                                       {{-- @if ($data->dataUser->id == Auth::user()->id
                                          || (Auth::user()->role != "Guru" 
                                          && Auth::user()->role != "Siswa" ))  --}}
                                          <tr>
                                             <th scope="row">{{ $loop->iteration }}</th>
                                             <td>{{ $data->dataUser['nama'] }}</td>
                                             <td>{{ $data->kegiatan }}</td>
                                             {{-- <td>{{ $data->tujuan }}</td> --}}
                                             <td>{{ $data->tgl_peminjaman->isoFormat('D MMMM Y') }} - {{ $data->tgl_pengembalian->isoFormat('D MMMM Y') }}</td>
                                             {{-- <td>
                                                kondisi peminjaman : {{ $data->kondisi_peminjaman }} <br>
                                                kondisi pengecekan : {{ $data->kondisi_pengecekan }} <br>
                                                kondisi pengembalian : {{ $data->kondisi_pengembalian }} 
                                             </td> --}}
                                             <td>
                                                @if ( $data->status == "1")
                                                   <div class="badge m-0 badge-white">Pilih Alat yang ingin dipinjam</div>
                                                @elseif ( $data->status == "2")
                                                   <div class="badge m-0 badge-secondary">Menunggu penyetujuan Peminjaman</div>
                                                @elseif ( $data->status == "3")
                                                   <div class="badge m-0 badge-secondary">Menunggu penyediaan</div>
                                                @elseif ( $data->status == "4")
                                                   <div class="badge m-0 badge-warning">Alat dapat diambil</div>
                                                @elseif ( $data->status == "5")
                                                   <div class="badge m-0 badge-info">Alat dipinjam</div>
                                                @elseif ( $data->status == "6")
                                                   <div class="badge m-0 badge-secondary">Menunggu penyetujuan pengembalian</div>
                                                @elseif ( $data->status == "7")
                                                   <div class="badge m-0 badge-secondary">Proses pengecekan alat</div>
                                                @elseif ( $data->status == "8")
                                                   <div class="badge m-0 badge-success">Alat dikembalikan</div>
                                                @else
                                                   <div class="badge m-0 badge-danger">Ditolak</div>
                                                   {{-- <p class="alert alert-danger m-0 p-1">{{ $data->status }}</p> --}}
                                                @endif
                                             </td>
                                             {{-- <td>{{ $data->dataAlat }}</td> --}}
                                             {{-- <td>
                                                @foreach ($data->dataAlat as $item)
                                                {{ $item['nama'] }}
                                                @endforeach
                                             </td> --}}
                                             
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
                                                @if ( $data->status == "1")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                         @if ($data->dataUser->id == Auth::user()->id || Auth::user()->role == "Kepala Jurusan" )
                                                         <a href="/peminjaman/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>
                                                         
                                                         <form action="/peminjaman/{{ $data->uuid }}" method="post"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="a dropdown-item"><a>Hapus</a></button>
                                                         </form>
                                                         @endif
                                                      </div>
                                                   </div>
                                                @elseif ( $data->status == "2")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                         @if (Auth::user()->role == "Kepala Jurusan")
                                                            <a href="/peminjaman/{{ $data->uuid }}/edit" class="dropdown-item">Edit</a>
                                                            
                                                            <form action="/peminjaman/{{ $data->uuid }}" method="post"
                                                               class="d-inline">
                                                               @method('delete')
                                                               @csrf
                                                               <button type="submit" class="a dropdown-item"><a>Hapus</a></button>
                                                            </form>
                                                         @endif
                                                      </div>
                                                   </div>
                                                @elseif ( $data->status == "3")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                      </div>
                                                   </div>
                                                @elseif ( $data->status == "4")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>

                                                         @if (Auth::user()->role == "Kepala Jurusan")
                                                         <form action="/status4-peminjamanAlat/{{ $data->uuid }}"
                                                               method="POST" class="d-inline">
                                                               @method('GET')
                                                               @csrf
                                                            {{-- <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}"> --}}
                                                            {{-- <input type="hidden" name="namaAlat" value="{{ $item->nama }}"> --}}
                                                            <input type="hidden" name="uuid"
                                                               value="{{ $data->uuid }}">
                                                            {{-- <input type="hidden" name="uuidAlat"
                                                               value="{{ $item->uuid }}">
                                                            <input type="hidden" name="uuidPivot"
                                                               value="{{ $item->pivot->uuid }}"> --}}
                                                            <button class="btn btn-success"  class="dropdown-item">Pinjam Alat</button>
                                                         </form>
                                                         @endif
                                                         
                                                      </div>
                                                   </div>
                                                @elseif ( $data->status == "5")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                         {{-- @if (Auth::user()->id == $datas->namaUser) --}}
                                                         {{-- @endif --}}
                                                         @if (Auth::user()->id == $data->dataUser->id)
                                                         {{-- {{ dd($data->dataUser) }} --}}
                                                         <form action="/status5-peminjamanAlat/{{ $data->uuid }}"
                                                               method="POST" class="d-inline">
                                                               @method('GET')
                                                               @csrf
                                                            {{-- <input type="hidden" name="namaUser" value="{{ $datas->dataUser->nama }}"> --}}
                                                            {{-- <input type="hidden" name="namaAlat" value="{{ $item->nama }}"> --}}
                                                            <input type="hidden" name="uuid"
                                                               value="{{ $data->uuid }}">
                                                            {{-- <input type="hidden" name="uuidAlat"
                                                               value="{{ $item->uuid }}">
                                                            <input type="hidden" name="uuidPivot"
                                                               value="{{ $item->pivot->uuid }}"> --}}
                                                            <button class="btn btn-success"  class="dropdown-item">Kembalikan Alat</button>
                                                         </form>
                                                         @endif
                                                      </div>
                                                   </div>
                                                @elseif ( $data->status == "6")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                      </div>
                                                   </div>
                                                @elseif ( $data->status == "7")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                      </div>
                                                   </div>
                                                @elseif ( $data->status == "8")
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                      </div>
                                                   </div>
                                                @else
                                                   <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         Aksi
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                         <a href="/detail-peminjamanAlat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                                                      </div>
                                                   </div>
                                                @endif
                                             </td>
                                             {{-- /Tombol Aksi Dropdown --}}
                                          </tr>
                                       {{-- @endif --}}
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

