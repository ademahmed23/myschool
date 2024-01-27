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
                     <h1>Class Timetable</h1>
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
                             <h3 class="card-title">Search Timetable</h3>
                               @include('message')

                         </div>
                         <div class="card-body p-0">
                             <form method="get" method="">
                                 <div class="row m-2">
                                     <div class="col-md-3 ">
                                         <label for="">Class Name</label>
                                         <select class="form-control getClass" name="class_id" required>
                                             <option value="">Select</option>
                                             @foreach($getClass as $class)
                                             <option {{(Request::get('class_id') == $class->id)? 'selected' : ''}}
                                                 value="{{$class->id}}">{{$class->name}}</option>
                                             @endforeach
                                         </select>

                                     </div>
                                     <div class="col-md-3 ">
                                         <label for="">Subject Name</label>
                                          <select class="form-control getrecords" name="subject_id" required>
                                             <option value="">Select</option>
                                          @if(!empty($getrecords)){
                                             @foreach($getrecords as $subjects)
                                             <option {{(Request::get('Subject_id') == $subjects->id)? 'selected' : ''}}
                                                 value="{{ $subjects->subject_id}}">{{$subjects->subject_name}}</option>
                                             @endforeach
                                            @endif
                                                </select>
                                     </div>
                                     <div class="col-md-3">
                                         <button class="btn btn-primary" type="submit"
                                             style="margin-top:31px;">Search</button>
                                         <a href="{{('admin/class_timetable/list')}}" class="btn btn-success"
                                             style="margin-top:31px;">Reset</a>
                                     </div>
                                 </div>
                             </form>
                         </div>
                         
                     </div>

           @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))



                            <form action="{{ url('admin/class_timetable/add')}}" method="POST">
                                @csrf
                                <input type="hidden" name="subject_id" value="{{ Request::get('subject_id')}}">
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">

                       <div class="card">
                         <div class="card-header col-md-12 ">
                             <h3 class="card-title">Class Timetable</h3>
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
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($week as $value)
                                    <tr>
                                        <th>
                                <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{$value['week_id']}}">

                                            {{$value['week_name']}}
                                      </th>
                                        <td>
                                            <input type="time" name="timetable[{{ $i }}][start_time]" value="{{$value['start_time']}}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="time" name="timetable[{{ $i }}][end_time]" value="{{$value['end_time']}}"class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" style="width:200px;" name="timetable[{{ $i }}][room_number]" value="{{ $value['room_number']}}" class="form-control">
                                        </td>
                                        
                                    </tr>
                                    @php
                                   $i++;
                                   @endphp
                                    @endforeach


                                 </tbody>
                             </table>
                             <div style="text-align: right; padding-right: 200px;">
                                   <button class="btn btn-primary">Submit</button>
                             </div>
                           
                             
                         </div>
                         <!-- /.card-body -->

                     </div>
                 </form>
                 @endif
                 </div>
             </div>
         </div>
     </div>

     {{-- serarc bar exit --}}
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
 </div>
 </div><!-- /.container-fluid -->
 </section>
 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->


 @endsection

 @section('script')
 <script type="text/javascript">
$('.getClass').change(function() {
    var class_id = $(this).val();
    $.ajax({
        url: "{{ url('admin/class_timetable/get_subject') }}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            class_id: class_id,
        },
        dataType: "json",
        success:function(response) {
            $('.getrecords').html(response.html)

        },

    });
});
 </script>
 @endsection