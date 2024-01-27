@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-center align-items-center vh-10">
                <img src="{{ url('uploads/profiles/oda.PNG') }}" alt="Centered Image">
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Timetable</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- search bar --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @foreach($getrecord as $value)
                    <div class="card">
                        <div  style="background-color:royalblue; " class="card-header col-md-12 ">
                            <h3 style="color:white; font-weight: bold; " class="card-title">{{$value['name']}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                       <td>Subject Name</td>
                                        <td>Days</td>
                                        <td>Exam Date</td>
                                        <td>Start Time</td>
                                        <td>End Time</td>
                                        <td>Room Number</td>
                                        <td>Full Mark</td>
                                        <td>Pass Marks</td>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($value['exam'] as $valueS)
                                   <tr>
                                       <td>{{ $valueS['subject_name']}}</td>
                                       <td>{{ date('l', strtotime($valueS['exam_date']))}}</td>
                                       <td>{{ date('d-m-Y', strtotime($valueS['exam_date']))}}</td>
                                       <td>{{date('h:i A', strtotime($valueS['start_time'])) }}</td>
                                       <td>{{ date('h:i A', strtotime($valueS['end_time']))}}</td>
                                       <td>{{ $valueS['room_number']}}</td>
                                       <td>{{ $valueS['full_mark']}}</td>
                                       <td>{{ $valueS['pass_mark']}}</td>
                                   </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- search bar exit --}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

