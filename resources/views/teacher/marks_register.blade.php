@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student's Marks List</h1>
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
                                             <option {{ (Request::get('exam_id') == $exam->exam_id)? 'selected' : ''}} value="{{ $exam->exam_id}}">{{ $exam->exam_name}}</option>

                                             @endforeach

                                         </select>

                                     </div>
                                   
                                     
                                     <div class="col-md-3">
                                       <label for="">Class</label>
                                         <select class="form-control" name="class_id" required>
                                             <option value="">Select</option>
                                             @foreach($getClass as $class)
                                             <option {{ (Request::get('class_id') == $class->class_id)? 'selected' : ''}} value="{{ $class->class_id}}">{{ $class->class_name}}</option>

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
                        <h3>Mark Register</h3>
                           
                        </div>
                          
                                @csrf
                                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id')}}">
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">

                            @if(!empty($getSubject)&& !empty($getSubject->count())) 

                    <div class="card">
                      
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead style="background-color:royalblue; color: white; font-weight: bold;" >
                                    <tr>
                                        
                                        <th>Student Name</th>
                                        @foreach($getSubject as $subjects)
                                        <th>{{$subjects->subject_name}} <br /> 
                                           {{$subjects->subjects_type}} ({{$subjects->pass_mark}}/{{$subjects->full_mark}})</th>
                                        @endforeach
                                        <th>Action</th>


                                    </tr>
                                </thead>
                            <tbody>
                                @if(!empty($getStudent) && !empty($getStudent->count()))
                                 @foreach($getStudent as $student)
                                 <form name ="POST" class="SubmitForm">
                                    {{csrf_field()}}
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                    <input type="hidden" name="exam_id" value="{{ Request::get('exam_id')}}">
                                    <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">
                                 <tr style="background-color:burlywood; font-weight: bold;">
                                     <td>
                                         {{$student->name}}   
                                         {{$student->last_name}}

                                         
                                     </td>
                                     @php 
                                     $i = 1;
                                     $totalStudentMark = 0;
                                     $totalFullMark = 0;
                                     $totalPassMark = 0;
                                     $pass_faild_validation=0;
                                     @endphp
                                     @foreach($getSubject as $subjects)
                                     @php
                                    $totalMark=0;
                                    $totalFullMark = $totalFullMark + $subjects->full_mark;
                                    $totalPassMark = $totalPassMark + $subjects->pass_mark;
                                     $getMark = $subjects->getMark($student->id, Request::get('exam_id'), Request::get('class_id'),$subjects->subject_id);
                                     if(!empty($getMark)){
                                        $totalMark = $getMark->test + $getMark->class_work + $getMark->assignment + $getMark->home_work + $getMark->mid_exam + $getMark->final_exam;

                                     }
                                     $totalStudentMark = $totalStudentMark + $totalMark;
                                     @endphp
                                     <td>
                                        <div style=" margin-bottom: 10px; min-width: 100px;">
                                        Test
                                         <input style="width: 150px;" type="hidden" name="mark[{{ $i }}][full_mark]" value="{{$subjects->full_mark}}">
                                        <input style="width: 150px;" type="hidden" name="mark[{{ $i }}][pass_mark]" value="{{$subjects->pass_mark}}">
                                        <input style="width: 150px;" type="hidden" name="mark[{{ $i }}][id]" value="{{$subjects->id}}">
                                        <input style="width: 150px;" type="hidden" name="mark[{{ $i }}][subject_id]" value="{{$subjects->subject_id}}">
                                         <input style="width: 150px;" type="text" name="mark[{{ $i }}][test]" placeholder="Enter Marks" class="form-control" 
                                         value="{{!empty($getMark) ? $getMark->test : ''}}" id="test_{{$student->id}}{{$subjects->subject_id}}">
                                     </div>
                                     <div  margin-bottom: 10px;>
                                         Class Work
                                         <input style="width: 150px;" type="hidden" name="mark[{{$i}}][subject_id]" value="{{$subjects->subject_id}} " value="{{!empty(($getMark)? $getMark->test : '')}}" id="{{$student->id}}{{$subjects->subject_id}}">

                                         <input style="width: 150px;" type="text" value="{{!empty($getMark) ? $getMark->class_work : ''}}" name="mark[{{$i}}][class_work]"  placeholder="Enter Marks" class="form-control" id="class_work_{{$student->id}}{{$subjects->subject_id}}">
                                     </div>
                                     <div style=" margin-bottom: 10px;">
                                       Assignment
                                         <input style="width: 150px;" type="text" value="{{!empty($getMark) ? $getMark->assignment : ''}}" name="mark[{{ $i }}][assignment]"placeholder="Enter Marks" class="form-control" id="assignment_{{$student->id}}{{$subjects->subject_id}}">
                                     </div>
                                     <div style=" margin-bottom: 10px;">
                                       Home Work
                                         <input style="width: 150px;" type="text"value="{{!empty($getMark) ? $getMark->home_work : ''}}" name="mark[{{ $i }}][home_work]"placeholder="Enter Marks" class="form-control" id="home_work_{{$student->id}}{{$subjects->subject_id}}">
                                     </div>
                                     <div  style=" margin-bottom: 10px;">
                                         Mid-Exam
                                         <input style="width: 150px;" type="text" value="{{!empty($getMark) ? $getMark->mid_exam : ''}}" name="mark[{{ $i }}][mid_exam]" placeholder="Mid-Exam Mark" class="form-control" id="mid_exam_{{$student->id}}{{$subjects->subject_id}}">
                                     </div>
                                     <div style=" margin-bottom: 10px;">
                                         Final-Exam
                                         <input style="width: 150px;" type="text" value="{{!empty($getMark) ? $getMark->final_exam : ''}}" name="mark[{{ $i }}][final_exam]" placeholder="final-Exam Mark"class="form-control" id="final_exam_{{$student->id}}{{$subjects->subject_id}}">
                                     </div>
                                     <div>
                                     <button type="button" class="btn btn-primary btn-sm SaveSingleSubject" id="{{$student->id}}" data-value="{{$subjects->subject_id}}" data-schedule="{{$subjects->id}}" data-exam="{{ Request::get('exam_id')}}" data-class="{{ Request::get('class_id')}}">Save</button></div>
                                     @if(!empty($getMark))
                                     <div style="margin-top: 10px;">
                                     <b>Total Mark:</b> {{$totalMark}} <br/>
                                     <b>Pass Mark:</b> {{$subjects->pass_mark}}<br/>
                                       @if($subjects->pass_mark <= $totalMark)
                                       <span style="color: green; font-weight: bold; font-style: italic;">PASSED</span>
                                       @else
                                       <span style="color: red; font-weight: bold; font-style: italic;">FAILED</span>
                                      @php 
                                      $pass_faild_validation=1;
                                      @endphp

                                       @endif
                                 </div> 
                                     @endif
                                     </td>

                                     @endforeach
                                     @php 
                                     $i++;
                                     @endphp
                                    <div > <td style="min-width: 180px;" >
                                         <button type="submit" class="btn btn-success btn-sm">Save</button>      
                                        <button type="Reset" class="btn btn-primary btn-sm">Reset</button><br/>
                                        @if(!empty($totalStudentMark))
                                        Full Marks:  {{$totalFullMark}}<br/>
                                        Total Marks: {{$totalStudentMark}} <br/>
                                        Pass Mark :  {{ $totalPassMark}}<br/>
                                        @php
                                        $Average=$totalStudentMark * 100/$totalFullMark;

                                      
                                        @endphp 

                                    @if($pass_faild_validation == 0)

                                     
                                       Average: {{ round($Average,2) }}%<br>
                                       Status: <span style="color: green; font-weight: bold; font-style: italic;">PASSED</span>
                                       @else
                                        Average: {{round($Average,2)}}% <br>
                                       Status: <span style="color: red; font-weight: bold; font-style: italic;">FAILED</span>
                                       @endif
                                       @endif


                                                                    
                                  </td></div>
                              </tr>
                             </form>
                                    @endforeach
                                  @endif
                            </tbody>
                                
                            </table>
                             
            </div>
                       

                        </div>
                        @endif
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
@section('script').
<script type="text/javascript">
    $('.SubmitForm').submit(function(e){
        e.preventDefault();
$.ajax({
type:"POST",
url: "{{url('teacher/submit_mark_register')}}",
data:$(this).serialize(),
dataType : "json",
success: function(data){
alert(data.message);
}
});
    });
    $('.SaveSingleSubject').click(function(e){
var student_id =$(this).attr('id');
var subject_id = $(this).attr('data-value');
var exam_id = $(this).attr('data-exam');
var class_id = $(this).attr('data-class');
var id = $(this).attr('data-schedule');
var test = $('#test_' +student_id+subject_id).val();
var class_work = $('#class_work_' +student_id+subject_id).val();
var assignment = $('#assignment_' +student_id+subject_id).val();
var home_work = $('#home_work_' +student_id+subject_id).val();
var mid_exam = $('#mid_exam_' +student_id+subject_id).val();
var final_exam = $('#final_exam_' +student_id+subject_id).val();
$. ajax({
type:"POST",
url: "{{url('teacher/singlesubmit_mark_register')}}",
data:{
    "_token" : "{{csrf_token()}}",
    id :id,
    student_id :student_id,
    subject_id :subject_id,
    exam_id :exam_id,
    class_id :class_id,
    test : test,
    class_work : class_work,
    assignment : assignment,
    home_work :home_work,
    mid_exam : mid_exam,
    final_exam : final_exam,


},
dataType : "json",
success: function(data){
alert(data.message);
}
});

    });
</script>
@endsection   