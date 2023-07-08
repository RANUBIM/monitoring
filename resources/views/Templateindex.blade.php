@extends('template.template');
@section('content')
   <div class="main-content">
      <section class="section">
         <div class="section-header">
               <h1>Table</h1>
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
                              <h4>Hover</h4>
                           </div>
                           <div class="card-body">
                              <div class="section-title mt-0">Light</div>
                              <table class="table table-hover table-bordered">
                                 <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">First</th>
                                          <th scope="col">Last</th>
                                          <th scope="col">Handle</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                       <tr>
                                          <th scope="row">1</th>
                                          <td>Mark</td>
                                          <td>Otto</td>
                                          <td>@mdo</td>
                                       </tr>
                                       <tr>
                                          <th scope="row">2</th>
                                          <td>Jacob</td>
                                          <td>Thornton</td>
                                          <td>@fat</td>
                                       </tr>
                                       <tr>
                                          <th scope="row">3</th>
                                          <td>Larry</td>
                                          <td>the Bird</td>
                                          <td>@twitter</td>
                                       </tr>
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