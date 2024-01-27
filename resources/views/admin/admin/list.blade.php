 @extends('layouts.app')
 @section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Admin List </h1>
                                                                                              
                         </div>
                 <div class="col-sm-6" style="text-align:right">
                     <a href="{{url('admin/admin/add')}}" alt="Centered Image" class="btn btn-primary btn-sm">Add New Admin</a>
                 </div>
                  <div class="d-flex justify-content-center align-items-center vh-10">
        <img src="{{ url('uploads/profiles/oda.PNG') }}" alt="Centered Image"> 
    </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>
     {{-- search bar --}}
     <div class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-header col-md-12 ">
                             <h3 class="card-title"> Search</h3>
                         </div>
                         <div class="card-body p-0" style="overflow: auto;">
                             <form method="get" method="">
                                 <div class="row m-2">
                                     @csrf
                                     <div class="col-md-3 ">
                                         <label for="">Name</label>
                                         <input type="text" class="form-control" name="name"
                                             value="{{Request::get('name')}}" id="validationCustom01"
                                             placeholder="Enter Name">
                                     </div>
                                     <div class="col-md-3">
                                         <label for="">Email</label>
                                         <input type="text" class="form-control" name="email"
                                             value="{{Request::get('email')}}" id="validationCustom01"
                                             placeholder="Enter Name">
                                     </div>
                                     <div class="col-md-3">
                                         <label for="">Date</label>
                                         <input type="date" class="form-control" name="date"
                                             value="{{Request::get('date')}}" id="validationCustom01"
                                             placeholder="Enter Name">
                                     </div>
                                     <div class="col-md-3">
                                         <button class="btn btn-primary btn-sm" type="submit"
                                             style="margin-top:31px;">Search</button>
                                         <a href="{{route('add_list')}}" class="btn btn-success btn-sm"
                                             style="margin-top:31px;">Reset</a>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     {{-- serarc bar exit --}}
     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 @include('message')
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-header col-md-12 ">
                             <h3 class="card-title">Admin List (Total : {{$getrecords->total()}})</h3>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body p-0">
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th style="">Id</th>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th style="">Create Date</th>
                                         <th style=" text-align: center">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($getrecords as $value)
                                     <tr>
                                         <td>{{$value->id}}</td>
                                         <td>{{$value->name}}</td>
                                         <td>{{$value->email}}</td>
                                         <td>{{date('d-m-y H:i A',strtotime($value->created_at))}} </td>
                                        <div> <td style=" text-align: center">
                                             <a href="{{url('admin/admin/edit/'.$value->id)}}"
                                                 class="btn btn-primary btn-sm">Edit</a>
                                                  

                                             <a href="{{url('admin/admin/delete/'.$value->id)}}"
                                                 class="btn btn-danger btn-sm">Delete</a></td>
                                         </div>
                                     </tr>

                                     @endforeach

                                 </tbody>
                             </table>
                             <div class="" style="padding:10px; float:right;">
                                 {!! $getrecords->appends(Illuminate\Support\Facades\Request::except('page'))->links()
                                 !!}
                             </div>
                         </div>
                         <!-- /.card-body -->

                     </div>
                     <!-- /.card -->
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 @endsection