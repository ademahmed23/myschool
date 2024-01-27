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
                        <div  style="background-color:royalblue;" class="card-header col-md-12 ">
                            <h3 style="color:white; " class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Week Day</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($getrecords as $valueW)
                                    <tr>
                                        <td>{{ $valueW['week_name']}}</td>
                                        <td>{{ !empty($valueW['start_time']) ? date('h:i A',strtotime($valueW['start_time'])): ''}}</td>
                                        <td>{{ !empty($valueW['end_time']) ? date('h:i A',strtotime($valueW['end_time'])): ''}}</td>
                                        <td>{{ $valueW['room_number']}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
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
