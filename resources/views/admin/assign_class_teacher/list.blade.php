 @extends('layouts.app')
 @section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Assign Class List</h1>
                 </div>
                 <div class="col-sm-6" style="text-align:right">
                     <a href="{{url('admin/assign_class_teacher/add')}}" class="btn btn-primary">Assign new Subject </a>
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
                             <h3 class="card-title">Assigned Classes</h3>
                         </div>
                         <div class="card-body p-0">
                             
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
                            
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body p-0" style="overflow: auto" ;>
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th style="">Id</th>
                                         <th>Class Name</th>
                                         <th>Teacher Name</th>
                                         <th>Status</th>
                                         <th>Created by</th>
                                         <th style="">Create Date</th>
                                         <th style=" text-align: center">Action</th>
                                     </tr>
                                 </thead>
                             
                                     <tbody>
                                     @foreach ($getrecord as $value)
                                     <tr>
                                         <td>{{$value->id}}</td>
                                         <td>{{$value->class_name}}</td>
                                         <td>{{$value->teacher_name}} {{$value->teacher_last_name}}</td>
                                         <td>
                                             @if($value->status == 0)
                                             <b>Active</b>
                                             @elseif($value->status == 1)
                                             <b>Inactive</b>
                                             @endif
                                         </td>
                                         <td>{{$value->create_by_name}}</td>
                                         <td>{{date('d-m-y H:i A',strtotime($value->created_at))}} </td>
                                         <td style=" text-align: center">
                                             <a href="{{url('admin/assign_class_teacher/edit/'.$value->id)}}"
                                                 class="btn btn-primary btn-sm">Edit</a>
                                             <a href="{{url('admin/assign_class_teacher/edit_single/'.$value->id)}}"
                                                 class="btn btn-primary btn-sm">Singel Edit</a>
                                                 <a href="{{url('admin/assign_class_teacher/delete/'.$value->id)}}"
                                                 class="btn btn-danger btn-sm">Delete</a>
                                                 
                                         </td>
                                     </tr>
                                     @endforeach
                                 
                                 </tbody>
                             </table>
                             <div class="" style="padding:10px; float:right; padding">
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