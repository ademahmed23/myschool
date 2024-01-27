<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\ClassSubejctModel;
use App\Models\User;
use App\Models\ExamScheduleModel;
use App\Models\AssignClassTeacherModel;
use App\Models\MarkRegisteringModel;
use Auth;

class  ExaminationController extends Controller

{



      public function list()
    {
        $data['getrecord'] = ExamModel::getrecord();
        $data['header_title'] = 'Exam List';
        return view('admin.examination.exam.list', $data);
        
    }

    public function add()
    {
        $data['header_title'] = "Add New Exam";
        return view('admin.examination.exam.add', $data);
    }
    public function insert(Request $request){
      
$exam = new ExamModel;
$exam ->name=trim($request->name);
$exam->note = trim($request->note);
$exam->created_by=Auth::user()->id;
$exam->save();

return redirect('admin/examination/exam/list')->with('success','exam successfully added');
    }

    public function edit($id){
        $data['getrecord'] = ExamModel::getsingle($id);
        if (!empty($data['getrecord'])) {
             $data['header_title'] = 'Edit Exam';
        return view('admin.examination.exam.edit', $data);

           
        }else{
            abort(404);
        }
       
      }
public function update($id,Request $request){
    $exam = ExamModel::getsingle($id);
$exam ->name=trim($request->name);
$exam->note = trim($request->note);
$exam->created_by=Auth::user()->id;
$exam->save();


return redirect('admin/examination/exam/list')->with('success','exam successfully updated');

  }
  public function delete($id){
     $getrecord = ExamModel::getsingle($id);
        if (!empty($getrecord)) {
            $getrecord->is_delete=1;
            $getrecord->save();
            

return redirect()->back()->with('success','exam successfully Deleted');

  }else{
    abort(404);
  }
}
public function exam_schedule(Request $request){
 $data['getClass'] = ClassModel::getClass();
$data['getExam'] = ExamModel::getExam();
$result = array();
if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
   $getSubject=ClassSubejctModel::mySubject($request->get('class_id'));
 foreach($getSubject as $value) {
 $dataS = array();
 $dataS['subject_id'] = $value->subject_id;
$dataS['class_id'] = $value->class_id;
 $dataS['subject_name'] =  $value->subject_name;
 $dataS['subject_type'] = $value->subject_type;
 $ExamSchedule = ExamScheduleModel::getsingle($request->get('exam_id'),$request->get('class_id'),$value->subject_id);
 if (!empty($ExamSchedule)) {
$dataS['exam_date'] = $ExamSchedule->exam_date;
$dataS['start_time'] = $ExamSchedule->start_time;
    $dataS['end_time'] = $ExamSchedule->end_time;
    $dataS['room_number'] =$ExamSchedule->room_number;
    $dataS['full_mark'] = $ExamSchedule->full_mark;
    $dataS['pass_mark'] = $ExamSchedule->pass_mark;
 }else{
    $dataS['exam_date'] = '';
    $dataS['start_time'] = '';
    $dataS['end_time'] = '';
    $dataS['room_number'] = '';
    $dataS['full_mark'] = '';
    $dataS['pass_mark'] = '';
 }
 $result[] = $dataS;
 }
 }
 
$data['getrecord'] = $result;

 $data['header_title'] = 'Exam Schedule ';

         return view('admin.examination.exam_schedule', $data);

}
public function insert_schedule(Request $request){
     if (!empty($request->schedule)) {
      foreach($request->schedule as $schedule){
        if (!empty( $schedule['subject_id']) && !empty( $schedule['exam_date']) && !empty( $schedule['end_time']) && !empty( $schedule['room_number']) && !empty( $schedule['pass_mark']) && !empty( $schedule['full_mark'])) {
                    
        $exam = new ExamScheduleModel;
        $exam->exam_id =  $request->exam_id;
        $exam->class_id = $request->class_id;
        $exam->subject_id = $schedule['subject_id'];
        $exam->exam_date = $schedule['exam_date'];
        $exam->start_time = $schedule['start_time'];
        $exam->end_time = $schedule['end_time'];
        $exam->room_number = $schedule['room_number'];
        $exam->full_mark = $schedule['full_mark'];
        $exam->pass_mark = $schedule['pass_mark'];
        $exam->created_by = Auth::user()->id;
        $exam->save();
}
      
      }
    }
    return redirect()->back()->with('success','Exam Schedule Successfully Created');
    

}

public function MyExamSchedule(Request $request){
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
 $data['getrecord'] = $result;


    $data['header_title'] = "Exam Schedule";
    return view('student.my_exam_schedule',$data);
   


}
// teacher sdie
public function MyExamTimetable()
{
    $result = array();
    $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

    foreach ($getClass as $class) {
        $dataC = array();
        $dataC['class_name'] = $class->class_name;
        $getExam = ExamScheduleModel::getExam($class->class_id);

        $examArray = array();
        foreach ($getExam as $exam) {
            $dataE = array();
            $dataE['exam_name'] = $exam->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id);
            $subjectsArray = array();

            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['pass_mark'] = $valueS->pass_mark;
                $subjectsArray[] = $dataS;
            }

            if (!empty($subjectsArray)) {
                $dataE['subjects'] = $subjectsArray;
            } else {
               
                $dataE['subjects'] = array();
            }

            $examArray[] = $dataE;
        }

        $dataC['exam'] = $examArray;
        $result[] = $dataC;
    }

    $data['getrecord'] = $result;
    $data['header_title'] = "Exam Schedule";
   

    return view('teacher.my_exam_timetable', $data);
}
public function myStudentExam($student_id){
    $getStudent = User::getsingle($student_id);


  $class_id = $getStudent->class_id;
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
 $data['getrecord'] = $result;
 $data['getStudent'] = $getStudent;
    $data['header_title'] = "Exam Timetable";
    return view('parent.exam_timetable',$data);
   
}
public function MarksRegister(Request $request){

 $data['getClass'] = ClassModel::getClass();
 $data['getExam'] = ExamModel::getExam();
 if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
    $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'),$request->get('class_id'));

    $data['getStudent'] = User::getStudentClass($request->get('class_id'));

 }
 $data['header_title'] = 'Mark Register';
return view('admin.examination.marks_register', $data);
    
}
public function SubmitMarksRegister(Request $request){
     $validation = 0;
  if(!empty($request->mark)) {
    foreach($request->mark as $mark){
        $getExamSchedule = ExamScheduleModel::getSingleID($mark['id']);
        $full_mark = $getExamSchedule->full_mark;
        $test = !empty($mark['test']) ? $mark['test'] :0;
        $home_work = !empty($mark['home_work']) ? $mark['home_work'] :0;
        $class_work = !empty($mark['class_work']) ? $mark['class_work'] :0;
        $assignment = !empty($mark['assignment']) ? $mark['assignment'] :0;
        $mid_exam = !empty($mark['mid_exam']) ? $mark['mid_exam'] :0;
        $final_exam = !empty($mark['final_exam']) ? $mark['final_exam'] :0;
        $full_mark = !empty($mark['full_mark']) ? $mark['full_mark'] :0;
        $pass_mark = !empty($mark['pass_mark']) ? $mark['pass_mark'] :0;

        $total_mark = $test + $class_work + $assignment +$home_work + $mid_exam +  $final_exam;
         if ($full_mark >= $total_mark) {

         

        $getMark = MarkRegisteringModel::checkAlreayMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);
        if (!empty($getMark)) {
            $save =$getMark;

        }else{
            $save = new MarkRegisteringModel;
        $save->created_by = Auth::user()->id;


        }
        $save->student_id = $request->student_id;
        $save->exam_id = $request->exam_id;
        $save->class_id = $request->class_id;
        $save->subject_id = $mark['subject_id'];
        $save->test = $test;
        $save->home_work = $home_work;
        $save->class_work = $class_work;
        $save->assignment = $assignment;
        $save->mid_exam = $mid_exam;
        $save->final_exam = $final_exam;
        $save->full_mark = $getExamSchedule->full_mark;
        $save->pass_mark = $getExamSchedule->pass_mark;
        $save->save();
    }else{
            $validation = 1;
 
    }
    }

  }
  if ($validation == 0) {
  $json['message'] = "Marks Registered Successfully";


  }else{
  $json['message'] = "error, your some subjects your total mark greater than full mark ";

  }
  echo json_encode($json);

}
public function SingleSubmitMarksRegister(Request $request){
   
    $id = $request->id;
    $getExamSchedule = ExamScheduleModel::getSingleID($id);
    $full_mark = $getExamSchedule->full_mark;
        $test = !empty($request->test) ? $request->test :0;
        $class_work = !empty($request->class_work) ? $request->class_work :0;
        $assignment = !empty($request->assignment) ? $request->assignment :0;
        $home_work = !empty($request->home_work) ? $request->home_work :0;
        $mid_exam = !empty($request->mid_exam) ? $request->mid_exam :0;
        $final_exam = !empty($request->final_exam) ? $request->final_exam :0;
      
        $total_mark = $test + $class_work + $assignment +$home_work + $mid_exam +  $final_exam; 
        if ($full_mark >= $total_mark) {
           $getMark = MarkRegisteringModel::checkAlreayMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id);
        if (!empty($getMark)) {
            $save =$getMark;

        }else{
            $save = new MarkRegisteringModel;
        $save->created_by = Auth::user()->id;


        }
        $save->student_id = $request->student_id;
        $save->exam_id = $request->exam_id;
        $save->class_id = $request->class_id;
        $save->subject_id = $request->subject_id;
        $save->test = $test;
        $save->home_work = $home_work;
        $save->class_work = $class_work;
        $save->assignment = $assignment;
        $save->mid_exam = $mid_exam;
        $save->final_exam = $final_exam;
        $save->full_mark = $getExamSchedule->full_mark;
        $save->pass_mark = $getExamSchedule->pass_mark;
        $save->save();
        $json['message'] = "Marks Registered Successfully";
        }
        else{
            $json['message'] = "error, your total mark greater than full mark";
        }
        
  echo json_encode($json);
}
//Teacher Side MarkRegister
public function TeacheRMarksRegister(Request $request){

    $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
    $data['getExam'] = ExamScheduleModel::getExamTeacher(Auth::user()->id);
    
 if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
    $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'),$request->get('class_id'));
    $data['getStudent'] = User::getStudentClass($request->get('class_id'));
 }
 $data['header_title'] = 'Mark Register';
return view('teacher.marks_register', $data);
}
public function MyExamResults(){
    $result = array();
    $getExam = MarkRegisteringModel::getExam(Auth::user()->id);
    foreach($getExam as $value){
        $dataE = array();
        $dataE['exam_name'] = $value->exam_name;
         $getExamSubject = MarkRegisteringModel::getExamSubject($value->exam_id, Auth::user()->id);
         $dataSubject = array();
         foreach($getExamSubject as $exam){
            $total_score = $exam['test'] + $exam['class_work'] + $exam['assignment'] + $exam['home_work'] + $exam['mid_exam']+$exam['final_exam'];
            $dataS = array();
            $dataS['subject_name'] = $exam['subject_name'];
            $dataS['test'] = $exam['test'];
            $dataS['class_work'] = $exam['class_work'];
            $dataS['assignment'] = $exam['assignment'];
            $dataS['home_work'] = $exam['home_work'];
            $dataS['mid_exam'] = $exam['mid_exam'];
            $dataS['final_exam'] = $exam['final_exam'];
            $dataS['total_score'] = $total_score;
            $dataS['full_mark'] = $exam['full_mark'];
            $dataS['pass_mark'] = $exam['pass_mark'];
            $dataSubject[] = $dataS;
         }
         $dataE['subjects'] = $dataSubject;
         $result[] = $dataE;
    }
   $data['getrecord'] = $result;
    $data['header_title'] = 'My Exam Results';
        return view('student.my_exam_results', $data);

}
}
