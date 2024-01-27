@extends('layouts.app')
@section('content')
@section('style')
<style type="text/css">
    .fc-daygrid-event{
        white-space: normal;
    }
</style>
@endsection
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Student's Calendar <span style="color:  blueviolet;">({{$getStudent->name}} {{$getStudent->last_name}})</span></h1>
                        </div>
                        
                    </div>
                </div><!-- /.container-fluid -->
            </section>

<section class="content">
        <div class="container-fluid">
           
                <div class="col-md-12">
                    <div id="calendar"></div>
                  
                </div>
                
              
            
        </div>

</div>
</div><!-- /.container-fluid -->
</section>
<!-- /</section>.content -->
</div>
@endsection
@section('script')
<script src="{{ url('/public/dist/fullcalendar/index.global.js')}}"></script>

<script type="text/javascript">
  var events = new Array();
 @foreach ($getTimetable as $value)
  @foreach ($value['week'] as $week)
events.push({
  title: '{{$value['name']}}',
  daysOfWeek: [{{$week['fullcalendar_day']}}],
  startTime: '{{$week['start_time']}}',
  endTime: '{{$week['end_time']}}',
 });

  @endforeach
  @endforeach
    
    @foreach ($getExamTimetable as $valueE)
  @foreach ($valueE['exam'] as $exam)
events.push({
  title: '{{$valueE['name']}} ->> {{$exam['subject_name']}} ({{date('h:i A',strtotime($exam['start_time']))}}) to ({{date('h:i A',strtotime($exam['end_time']))}})',
  start: '{{$exam['exam_date']}}',
  end:' {{$exam['exam_date']}}',
  color: 'royalblue',
       


  
 });

  @endforeach
  @endforeach
var calendarID = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarID, {
    headerToolbar:{    
    left: 'prev, next today',
    center: 'title',
    right: 'dayGridMonth, timeGridWeek, timeGridDay, listMonth'
},
initialDate: '<?=date('Y-m-d')?>',
navLinks: true,
editable: false,
events: events,

});
calendar.render();
</script>
@endsection

