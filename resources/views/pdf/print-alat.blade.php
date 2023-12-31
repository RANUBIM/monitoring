<h3 style="text-align: center">DATA ALAT</h3>

<table style="text-align: display: block;
margin-left: auto;
margin-right: auto;" class="table table-hover table-responsive-lg table-bordered" id="example" border="1" >
   <thead>
         @if (Auth::user()->role === 'Kepala Jurusan')
            <tr>
               <th scope="col" rowspan="2">#</th>
               <th scope="col" rowspan="2">Labor</th>
               <th scope="col" rowspan="2">Nama</th>
               <th scope="col" rowspan="2">Spesifikasi</th>
               {{-- <th scope="col" rowspan="2">Keterangan</th> --}}
               <th scope="col" colspan="3" class="text-center">Stok</th>
            </tr>
            <tr>
               <th scope="col">Tersedia</th>
               <th scope="col">Dipinjam</th>
               <th scope="col">Total</th>
            </tr>
         @elseif (Auth::user()->role === 'Laboran')
            <tr>
               <th scope="col" rowspan="2">#</th>
               <th scope="col" rowspan="2">Labor</th>
               <th scope="col" rowspan="2">Nama</th>
               <th scope="col" rowspan="2">Spesifikasi</th>
               {{-- <th scope="col" rowspan="2">Keterangan</th> --}}
               <th scope="col" colspan="3" class="text-center">Stok</th>
               {{-- <th scope="col" rowspan="2">Aksi</th> --}}
            </tr>
            <tr>
               <th scope="col">Tersedia</th>
               <th scope="col">Dipinjam</th>
               <th scope="col">Total</th>
            </tr>
         @else
            <tr>
               <th scope="col">#</th>
               <th scope="col">Labor</th>
               <th scope="col">Nama</th>
               <th scope="col">Spesifikasi</th>
               {{-- <th scope="col" rowspan="2">Keterangan</th> --}}
               <th scope="col">Stok</th>
            </tr>
         @endif

   </thead>
   <tbody>
         @foreach ($datas as $data)
            <tr>
               <th scope="row">{{ $loop->iteration }}</th>
               <td>{{ $data->dataLabor['nama'] }}</td>
               <td>{{ $data->nama }}</td>
               <td>{{ $data->spesifikasi }}</td>
               {{-- <td>{{ $data->keterangan }}</td> --}}

               @if (Auth::user()->role === 'Kepala Jurusan')
                  <td>{{ $data->stok - $data->dipinjam }} {{ $data->satuan }}</td>
                  <td>{{ $data->dipinjam }} {{ $data->satuan }}</td>
                  <td>{{ $data->stok }} {{ $data->satuan }}</td>

                  {{-- Tombol Aksi Dropdown --}}
                  {{-- <td> --}}
                     {{-- <div class="dropdown"> --}}
                        {{-- <button class="btn btn-primary dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                              Aksi
                        </button> --}}
                        {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a href="/alat/{{ $data->uuid }}" class="dropdown-item">Detail</a>
                              <a href="/alat/{{ $data->uuid }}/edit"
                                 class="dropdown-item">Edit</a>

                              <form action="/alat/{{ $data->uuid }}" method="post"
                                 class="d-inline">
                                 @method('delete')
                                 @csrf
                                 <button type="submit"
                                    class="a dropdown-item"><a>Hapus</a></button>
                              </form>
                        </div> --}}
                     {{-- </div> --}}
                  {{-- </td> --}}
               @elseif (Auth::user()->role === 'Laboran')
                  <td>{{ $data->stok - $data->dipinjam }} {{ $data->satuan }}</td>
                  <td>{{ $data->dipinjam }} {{ $data->satuan }}</td>
                  <td>{{ $data->stok }} {{ $data->satuan }}</td>
               @else
                  <td>{{ $data->stok - $data->dipinjam }} {{ $data->satuan }}</td>
               @endif
               {{-- /Tombol Aksi Dropdown --}}
               {{-- <td>
               <a href="/alat/{{ $data->uuid }}/edit" class="btn btn-primary">Edit</a>

               <form action="/alat/{{ $data->uuid }}" method="post"
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