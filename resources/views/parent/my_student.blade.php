@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                     <div class="col-sm-6">
                            <h1>My Student</h1>
                        </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- search bar --}}
    
                            
                   
                       
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
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Create Date</th>
                                       
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
                                        <td>{{ $value->name }} {{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->parent_name }}</td>
                                        <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                                        <td style="min-width: 150px;">

                                           
                                            
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
                                      <th>Profile Picture</th>
                                        <th>Student Name</th>
                                        <th>parent Name</th>
                                        <th>Email</th>
                                        <th>Admission No.</th>
                                        <th>Roll No.</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>D_O_Birth</th>
                                        <th>Nationality</th>
                                        <th>Religion</th>
                                        <th>Mobile Number</th>
                                        <th>Admission Date</th>
                                        <th>Blood Group</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Status</th> 
                                        <th>created Date</th> 
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
                                        <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->admission_number }}</td>
                                        <td>{{ $value->roll_number }}</td>
                                        <td>{{ $value->class_name}}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>
                                            @if (!empty($value->date_of_birth))

                                            {{date('d-m-y', strtotime($value->date_of_birth))}}

                                            @endif
                                        </td>
                                        <td>{{ $value->nation }}</td>
                                        <td>{{ $value->religion }}</td>
                                        <td>{{ $value->mobile_number }}</td>
                                        <td>
                                            @if (!empty($value->admission_date))

                                            {{date('d-m-y H:i A', strtotime($value->admission_date))}}

                                            @endif
                                        </td>
                                        <td>{{ $value->blood_group }}</td>
                                        <td>{{ $value->height}}</td>
                                        <td>{{ $value->weight}}</td>
                                        <td>{{ ($value->status == 0)? 'Active':Inactive }}</td>
                                        <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                                         <td style="min-width:300px;">

                                            <a href="{{ url('parent/my_student/subject/'.$value->id) }}"
                                                class="btn btn-success btn-sm">Subject</a>
                                            <a href="{{ url('parent/my_student/exam_timetable/'.$value->id) }}"
                                                class="btn btn-primary btn-sm">Exam</a>
                                                <a href="{{ url('parent/my_student/calendar/'.$value->id) }}"
                                                class="btn btn-warning btn-sm"><b>Calendar</b></a>
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