@extends('layouts.app')
 @section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>My Class & Subject</h1>
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
                             <h3 class="card-title">My Classes And Subject</h3>
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
                            <h3 class="card-title">
                             
                            </h3>
                            
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body p-0" style="overflow: auto" ;>
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                        
                                         <th>Class Name</th>
                                         <th>Subject Name</th>
                                         <th>Subject Type</th>
                                         <th>My class Timetable</th>
                                         <th style="">Create Date</th>
                                         <th>Action</th>

                                         
                                     </tr>
                                 </thead>
                             
                                     <tbody>
                                      @foreach ($getrecords as $value)
                                     <tr>
                                         
                                         <td>{{$value->class_name}}</td>
                                         <td>{{$value->subject_name}}</td>
                                         <td>{{$value->subjects_type}}</td>

                                         <td>
                                            @php
                                       $ClassSubject = $value->getMyTimetable($value->class_id, $value->subject_id);
                                             @endphp
                                             @if(!empty($ClassSubject))

                                             {{date('h:i A',strtotime($ClassSubject->start_time))}} To {{date('h:i A',strtotime($ClassSubject->end_time))}}
                                             <br/>Room Number:{{$ClassSubject->room_number}}
                                             @endif 

                                         
                                         </td>

                                         <td>{{date('d-m-y H:i A',strtotime($value->created_at))}} </td>
                                          <td style=" text-align: center">
                                            <a href="{{ url('teacher/my_class_subject/class_timetable/'.$value->class_id.'/'.$value->subject_id) }}"
                                                class="btn btn-primary btn-sm">My Timetable</a>
                                            
                                        </td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                            
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