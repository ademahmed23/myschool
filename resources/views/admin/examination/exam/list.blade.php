@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam List</h1>
                </div>

                <div class="col-sm-6" style="text-align:right">
                    <a href="{{ url('admin/examination/exam/add') }}" class="btn btn-primary">Add New
                        Exam</a>
                </div>
                <div>     <div class="d-flex justify-content-center align-items-center vh-10">
        <img src="{{ url('uploads/profiles/oda.PNG') }}" alt="Centered Image"> 
    </div></div>
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
                         <div class="card-body p-0">
                             <form method="get" method="">
                                 <div class="row m-2">
                                     @csrf
                                     <div class="col-md-3 ">
                                         <label for="">Name</label>
                                         <input type="text" class="form-control" name="name"
                                             value="{{Request::get('name')}}" id="validationCustom01"
                                             placeholder="Exam Name">
                                     </div>
                                   
                                     
                                     <div class="col-md-3">
                                         <label for="">Date</label>
                                         <input type="date" class="form-control" name="date"
                                             value="{{Request::get('date')}}" id="validationCustom01"
                                             placeholder="Enter Name">
                                     </div>
                                     <div class="col-md-3">
                                         <button class="btn btn-primary" type="submit"
                                             style="margin-top:31px;">Search</button>
                                         <a href="{{url('admin/examination/exam/list')}}" class="btn btn-success"
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
                     <div class="card-header col-md-12 ">
                            <h3 class="card-title">Exam List (Total : {{ $getrecord->total() }})</h3>
                        </div>
                    <div class="card">
                      
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="min-width: 150px;">Id</th>
                                        <td>Name</td>
                                        <td>Note</td>
                                        <th>Created By</th>
                                        <td>Created Date</td>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getrecord as $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->note}}</td>
                                            <td>{{$value->created_by_name}}</td>
                                            <td> {{date('d-m-y', strtotime($value->updated_at))}}</td>
                                              
                                        <td style="min-width: 150px;">

                                            <a href="{{ url('admin/examination/exam/edit/'.$value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ url('admin/examination/exam/delete/'.$value->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a></td>
                                        
                                        </tr>
                                    
                                    @endforeach
                                   

                                </tbody>
                            </table>
                          <div class="" style="padding:10px; float:right;">
                                {!! $getrecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()
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







                          