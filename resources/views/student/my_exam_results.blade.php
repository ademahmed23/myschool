@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        My Exam Results
                    </h1>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($getrecord as $value)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header col-md-12 ">
                            <h3 class="card-title"> Results ( {{$value['exam_name'] }})
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th>Subjects Name</th>
                                        <th> Test</th>
                                        <th> Class Work</th>
                                        <th>Assignment</th>
                                        <th>Home Work</th>
                                        <th> Mid-Exam</th>
                                        <th> Final Exam</th>
                                        <th>Total Score</th>
                                        <th> Full mark</th>
                                        <th>Pass Mark</th>
                                        <th>Result</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_full_marks = 0;
                                    $total_score=0;
                                    $status_validation = 0;
                                    @endphp
                                     @foreach($value['subjects'] as $exam)
                                     @php
                                     $total_score = $total_score + $exam['total_score'];
                                     $total_full_marks = $total_full_marks + $exam['full_mark'];
                                     @endphp
                                  <tr style="min-width: 150px">
                                    <td >{{$exam['subject_name']}}</td>
                                    <td>{{$exam['test']}}</td>
                                    <td>{{$exam['class_work']}}</td>
                                    <td>{{$exam['assignment']}}</td>
                                    <td>{{$exam['home_work']}}</td>
                                    <td>{{$exam['mid_exam']}}</td>
                                    <td>{{$exam['final_exam']}}</td>
                                    <td>{{$exam['total_score']}}</td>
                                    <td>{{$exam['full_mark']}}</td>
                                    <td>{{$exam['pass_mark']}}</td>
                                    <td>
                                       
                                        @if($exam['total_score'] >=  $exam['pass_mark'])
                                        <span style="color:green; font-weight:bold; font-style: italic;">Passed</span>
                                        @else
                                    $status_validation = 1;

                                        <span style="color:red; font-weight:bold; font-style: italic;">Failed</span>
                                        @endif

                                    </td>


                                   </tr>
                                   @endforeach
                                   <tr>
                                       <td colspan="2">
                                           Grand Total: ({{$total_score}}/{{$total_full_marks}})
                                       </td> 
                                       <td colspan="2">
                                          Average: {{ round(($total_score*100)/$total_full_marks,2)}}
                                       </td>
                                       <td colspan="5">
                                          Status: @if($status_validation == 0)<span style="color:green; font-weight:1000; font-style:italic;">passed</span>
                                           @else 
                                           <span style="color:red;">Failed</span>
                                           @endif

                                       </td>
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
                @endforeach
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
