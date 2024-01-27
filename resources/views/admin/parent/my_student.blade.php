@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Parent Student Name Is ({{$getParent->name}} {{$getParent->last_name}})</h1>
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
                            <h3 class="card-title"> Search Student</h3>
                        </div>
                        <div class="card-body p-0">
                            <form method="get" method="">
                                <div class="row m-2">
                                    @csrf
                                    <div class="form-group col-md-2 ">
                                        <label for="">Student ID</label>
                                        <input type="text" class="form-control" name="id" value="{{Request::get('id')}}"
                                            id="validationCustom01" placeholder="Enter ID">
                                    </div>
                                    <div class="col-md-2 ">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{Request::get('name')}}" id="validationCustom01"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="col-md-2 ">
                                        <label for="">Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{Request::get('last_name')}}" id="validationCustom01"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{Request::get('email')}}" id="validationCustom01"
                                            placeholder="Enter Email">
                                    </div>

                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit"
                                            style="margin-top:33px;">Search</button>
                                        <a href="{{url('admin/parent/my_student/'.$parent_id)}}"
                                            class="btn btn-success btn-sm" style="margin-top:33px;">Reset</a>
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
                    @if (!empty($getSearchStudent))


                    <div class="card">

                        <div class="card-header col-md-12 ">
                        </div>

                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="">#</th>
                                        <th>Profile Pic</th>
                                        <th>Student Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getSearchStudent as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td> @if (!empty($value->getProfile()))
                                            <img src="{{$value->getProfile() }}"
                                                style="height: 50px; width:50px; border-radius:50px">

                                            @endif
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->parent_name }}</td>
                                        <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                                        <td style="min-width: 150px;">

                                            <a href="{{ url('admin/parent/assign_student_parent/'.$value->id.'/'.$parent_id) }}"
                                                class="btn btn-primary btn-sm">Add Student To parent</a>
                                            
                                        </td>




                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <div class="" style="padding:10px; float:right;">
 
                            </div>
                        </div>
                        @endif

                        <!-- /.card-body -->

                    </div>
                    <div class="card">
                        <div class="card-header col-md-12 ">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="">#</th>
                                        <th>Profile Pic</th>
                                        <th>Student Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getrecords as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td> @if (!empty($value->getProfile()))
                                            <img src="{{$value->getProfile() }}"
                                                style="height: 50px; width:50px; border-radius:50px">

                                            @endif
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->parent_name }}</td>
                                        <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                                        <td style="min-width: 150px;">

                                            <a href="{{ url('admin/parent/assign_student_parent_delete/'.$value->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                            
                                        </td>




                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <div class="" style="padding:10px; float:right;">
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