@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        My Subjects List
                    </h1>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('message')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header col-md-12 ">
                            {{-- <h3 class="card-title">Admin List  (Total : {{$getrecords->total() }})
                            </h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="">Id</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Created by</th>
                                        <th style="">Create Date</th>
                                        <th style=" text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($getrecords)
                                        @foreach($getrecords as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->subject_name}}</td>
                                                <td>{{ $value->subject_type}}</td>
                                                 <td>{{ ($value->status == 0)? 'Active':Inactive }}</td>
                                                <td>{{ $value->create_by}}</td>
                                                <td>{{ date('d-m-y H:i A',strtotime($value->created_at)) }}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ url('admin/subject/edit/'.$value->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{ url('admin/subject/delete/'.$value->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No records found.</td>
                                        </tr>
                                    @endif
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
