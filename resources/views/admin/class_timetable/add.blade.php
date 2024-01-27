 @extends('layouts.app')
 @section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Class Timetable List</h1>
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
                             <h3 class="card-title">Search Timetable</h3>
                         </div>
                         <div class="card-body p-0">
                             <form method="get" method="">
                                 <div class="row m-2">
                                     <div class="col-md-3 ">
                                         <label for="">Class Name</label>
                                         <input type="text" class="form-control" name="class_name"
                                             value="{{Request::get('class_name')}}" id="validationCustom01"
                                             placeholder="Enter Name">
                                     </div>
                                     <div class="col-md-3 ">
                                         <label for="">Subject Name</label>
                                         <input type="text" class="form-control" name="subject_name"
                                             value="{{Request::get('subject_name')}}" id="validationCustom01"
                                             placeholder="Enter Subject Type">
                                     </div>

                                     <div class="col-md-3">
                                         <button class="btn btn-primary btn-sm" type="submit"
                                             style="margin-top:31px;">Search</button>
                                         <a href="{{('admin/class_timetable/list')}}" class="btn btn-success btn-sm"
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