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
                                         <label for="">Exam Name</label>
                                         <select class="form-control" name="exam_id" required>
                                             <option value="">Select</option>
                                               @foreach($getExam as $exam)
                                             <option {{ (Request::get('exam_id') == $exam->id)? 'selected' : ''}} value="{{ $exam->id}}">{{ $exam->name}}</option>

                                             @endforeach

                                         </select>

                                     </div>
                                   
                                     
                                     <div class="col-md-3">
                                       <label for="">Class</label>
                                         <select class="form-control" name="class_id" required>
                                             <option value="">Select</option>
                                             @foreach($getClass as $class)
                                             <option {{ (Request::get('class_id') == $class->id)? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>

                                             @endforeach

                                         </select>

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
                        <h3>Exam Schedule</h3>
                           
                        </div>
                          <form action="{{ url('admin/examination/insert_schedule')}}" method="POST">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id')}}">
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">

                        @if(!empty($getrecord))
                    <div class="card">
                      
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead style="background-color:royalblue; color: white; font-weight: bold;" >
                                    <tr>
                                        
                                        <td>Subject Name</td>
                                        <td>Date</td>
                                        <td>Start Time</td>
                                        <td>End Time</td>
                                        <td>Room Number</td>
                                        <td>Full Mark</td>
                                        <td>Pass Marks</td>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                            
                                <tbody>
                                     @php
                                    $i=1;
                                    @endphp

                                       @foreach($getrecord as $value)

                                   <tr>
                                    <td style=" font-weight: bold;">{{ $value['subject_name']}}
                                        <input type="hidden" value="{{ $value['subject_id']}}" class="form-control" name="schedule[{{ $i }}][subject_id]">
                                    </td>
                                    <td>
                                        <input type="date"  class="form-control" value="{{ $value['exam_date']}}" name="schedule[{{ $i }}][exam_date]">
                                    </td><td>
                                        <input type="time" class="form-control" value="{{ $value['start_time']}}" name="schedule[{{ $i }}][start_time]">
                                    </td><td>
                                        <input type="time" class="form-control" value="{{ $value['end_time']}}" name="schedule[{{ $i }}][end_time]">
                                    </td><td>
                                        <input type="text" class="form-control" value="{{ $value['room_number']}}" name="schedule[{{ $i }}][room_number]">
                                    </td><td>
                                        <input type="text" class="form-control" value="{{ $value['full_mark']}}" name="schedule[{{ $i }}][full_mark]">
                                    </td><td>
                                        <input type="text" class="form-control"  value="{{ $value['pass_mark']}}"name="schedule[{{ $i }}][pass_mark]">
                                    </td>
                                        <td style="min-width: 150px;">

                                            <a href="{{ url('admin/examination/exam_schedule/edit') }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ url('admin/examination/exam_schedule/delete') }}"
                                                class="btn btn-danger btn-sm">Delete</a></td>

                                   </tr>
                                    @php
                                   $i++;
                                   @endphp
                                    @endforeach


                                </tbody>
                            </table>
                             <div style="text-align: center; padding: 20px;" class="card-footer">
              <button type="submit"  class="btn btn-primary">Update</button>
            </div>
                       

                        </div>
                        <!-- /.card-body -->
                    </div>
                    @endif
                </form>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection      
