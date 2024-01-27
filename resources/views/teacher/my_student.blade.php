@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Student List</h1>
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
                       
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="min-width: 150px;">Id</th>
                                        <th>Profile Picture</th>
                                        <th>Student Name</th>
                        
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
                                        <th>Created Date</th>
                                         


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
                                        
                                        <td>{{ date('d-m-y H:i A',strtotime($value->created_at)) }}</td>
                                        


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