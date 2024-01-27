<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubejctModel;
use App\Models\ClassModel;
use App\Models\WeekModel;
use App\Models\ExamScheduleModel;
use App\Models\ClassSubjectTimetableModel;
use App\Models\User;
use App\Models\AssignClassTeacherModel;
use Auth;


class CalenderController extends Controller
{
    //timetable

public function MyCalendar(){
     
    $data['getMyTimetable'] = $this->getTimetable(Auth::user()->class_id);
    $data['getExamTimetable'] = $this->getExamTimetable(Auth::user()->class_id);

        $data['header_title'] = 'My Calendar';
        return view('student.my_calendar', $data);
        
}
public function getExamTimetable($class_id){


 $class_id = Auth::user()->class_id;

   $getExam = ExamScheduleModel::getExam($class_id);
 

   $result = array();

   foreach($getExam as $value){
    $DataE = array();
    $DataE['name'] = $value->exam_name;
    $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id,$class_id);
    $resultS  = array();
foreach($getExamTimetable as $valueS){
    $dataS = array();
    $dataS['subject_name'] = $valueS->subject_name;
    $dataS['exam_date'] = $valueS->exam_date;
    $dataS['start_time'] = $valueS->start_time;
    $dataS['end_time'] = $valueS->end_time;
    $dataS['room_number'] = $valueS->room_number;
    $dataS['full_mark'] = $valueS->full_mark;
    $dataS['pass_mark'] = $valueS->pass_mark;
    $resultS[] = $dataS;


}
$DataE['exam'] = $resultS;
$result[] = $DataE;
  }
  return $result;

}

public function getTimetable($class_id){
    $result = array();
    $getrecords = ClassSubejctModel::mySubject($class_id);

    foreach ($getrecords as $value) {
        $dataS = array();
        $dataS['name'] = $value->subject_name;

        $getWeek = WeekModel::getrecords();
        $week = array();

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;
            $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;


            $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($value->class_id, $value->subject_id, $valueW->id);

            if (!empty($ClassSubject)) {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
                $dataW['room_number'] = $ClassSubject->room_number;
                 $week[] = $dataW;
            } 

           
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }
    return $result;

}
// parent Side 
public function StudentsParentCalendar($student_id){
    $getStudent = User::getsingle($student_id);
     $data['getExamTimetable'] = $this->getExamTimetable($getStudent->exam_id);
    $data['getMyTimetable'] = $this->getTimetable($getStudent->class_id);

    $data['getStudent'] = $getStudent;
        $data['header_title'] = 'Student Calendar';
        return view('parent.calendar', $data);

}
public function TCalendar(){


    $teacher_id = Auth::user()->id;
    $data['getClassTimetable'] =  AssignClassTeacherModel::getCalendarTeacher($teacher_id);
   $data['getExamTimetable'] = ExamScheduleModel::getExamTimetableT($teacher_id);
  
  $data['header_title'] = 'Teacher Calendar';
        return view('teacher.calendar', $data);
}
// Student Exam Results


}