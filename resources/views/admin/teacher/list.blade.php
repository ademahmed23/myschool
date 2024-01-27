@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Teacher List</h1>
                </div>
                <div class="col-sm-6" style="text-align:right">
                    <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary btn-sm">Add New Teacher</a>
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
                            <h3 class="card-title"> Search Teacher</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <form method="get" method="">
                                <div class="row m-2">
                                    @csrf
                                    <div class="col-md-2 ">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Request::get('name') }}" id="validationCustom01"
                                            placeholder="Enter FName">
                                    </div>
                                    <div class="col-md-2 ">
                                        <label for="">Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ Request::get('last_name') }}" id="validationCustom01"
                                            placeholder="Enter LName">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ Request::get('email') }}" id="validationCustom01"
                                            placeholder="Enter Name">
                                    </div>
                                
                                   
                                    <div class="col-md-3">
                                        <label for="">Date</label>
                                        <input type="date" class="form-control" name="date"
                                            value="{{ Request::get('date') }}" id="validationCustom01"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit"
                                            style="margin-top:31px;">Search</button>
                                        <a href="{{ route('admin.added_list') }}" class="btn btn-success btn-sm"
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
                            <h3 class="card-title" Teacher List (Total : {{ $getrecords->total() }})</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="min-width: 150px;">Id</th>
                                        <th>Profile Picture</th>
                                        <th>Teacher Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>D_O_Birth</th> 
                                        <th>Date Of Joinig</th>
                                        <th>Mobile Number</th>
                                        <th>Marital Status</th>
                                        <th>Current Address</th>
                                        <th>Permanent Address</th>
                                        <th>Qualification</th>
                                        <th>Work Experience</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
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
                                        <td>{{ $value->name }} {{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->gender}}</td>
                                        <td>
                                            @if (!empty($value->date_of_birth))

                                            {{date('d-m-y', strtotime($value->date_of_birth))}}

                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($value->admission_date))

                                            {{date('d-m-y', strtotime($value->admission_date))}}

                                            @endif
                                        </td>
                                        <td>{{ $value->mobile_number }}</td>
                                        <td>{{ $value->marital_status}}</td>

                                        <td>{{ $value->address}}</td>
                                        <td>{{ $value->permanent_address}}</td>
                                        <td>{{ $value->qualification}}</td>
                                        <td>{{ $value->work_experience}}</td>
                                        <td>{{ $value->note}}</td>
                                        <td>{{ ($value->status == 0)? 'Active':Inactive }}</td>
                                        <td>{{ date('d-m-y H:i A',strtotime($value->created_at)) }}</td>
                                        <td style="min-width: 150px;">

                                            <a href="{{ url('admin/teacher/edit/'.$value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ url('admin/teacher/delete/'.$value->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>


                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            <div class="" style="padding: 10px; float:right;">
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