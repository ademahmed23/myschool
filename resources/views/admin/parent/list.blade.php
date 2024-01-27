@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Parent List</h1>
                </div>
                <div class="col-sm-6" style="text-align:right">
                    <a href="{{url('admin/parent/add')}}" class="btn btn-primary btn-sm">Add New Parent</a>
                </div>
            </div>
                <div class="d-flex justify-content-center align-items-center vh-10">
        <img src="{{ url('uploads/profiles/oda.PNG') }}" alt="Centered Image"> 
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
                                        <a href="{{route('parent_list')}}" class="btn btn-success btn-sm"
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
                            <h3 class="card-title">Parent List (Total : {{$getrecords->total()}})</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="">#</th>
                                        <th>Profile Pic</th>
                                        <th>Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone Number</th>
                                        <th>Occupation</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getrecords as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td> @if (!empty($value->getProfile()))
                                            <img src="{{$value->getProfile() }}"
                                                style="height: 50px; width:50px; border-radius:50px">

                                            @endif
                                        </td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->last_name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->gender}}</td>
                                        <td>{{$value->mobile_number}}</td>
                                        <td>{{$value->occupation}}</td>
                                        <td>{{$value->address}}</td>
                                        <td>{{ ($value->status == 0)? 'Active':Inactive }}</td>


                                        <td>{{date('d-m-Y H:i A',strtotime($value->created_at))}} </td>



                                        <td style=" text-align: center; min-width: 150px;">
                                            <a href="{{url('admin/parent/edit/'.$value->id)}}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{url('admin/parent/my_student/'.$value->id)}}"
                                                class="btn btn-primary btn-sm">My Student</a>
                                            <a href="{{url('admin/parent/delete/'.$value->id)}}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
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