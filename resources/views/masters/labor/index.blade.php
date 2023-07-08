@extends('template.template')
@section('content')
   <div class="main-content">
      <section class="section">
         <div class="section-header">
               <h1>Labor</h1>
               <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                  <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                  <div class="breadcrumb-item">Table</div>
               </div>
         </div>

         <div class="section-body">
               {{-- <h2 class="section-title">Tables</h2>
               <p class="section-lead">
                  Examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap.
               </p> --}}

               <div class="row">
                  <div class="col-12 col-md-12 col-lg-12">
                     <div class="card">
                           <div class="card-header">
                              <a href="/labor" class="btn mdi-bookmark-off-outline btn-primary "><i class="fa fa-refresh"></i></a>
                              <a href="/labor/create" class="btn btn-primary ">Tambah</a>
                           </div>
                           <div class="card-body">
                              {{-- <div class="section-title mt-0">Light</div> --}}
                              <table class="table table-hover table-responsive-lg">
                                 <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Nama Labor</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($datas as $data)
                                       <tr>
                                          <th scope="row">{{ $loop->iteration }}</th>
                                          <td>{{ $data->name }}</td>
                                          <td>
                                             <a href="/labor/{{ $data->uuid }}/edit" class="btn btn-primary">Edit</a>

                                             <form action="/labor/{{ $data->uuid }}" method="post"
                                                   class="d-inline">
                                                   @method('delete')
                                                   @csrf
                                                   <button type="submit" class="btn btn-primary">Hapus</button>
                                             </form>
                                          </td>
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