<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\ClassSubejctModel;
use App\Models\WeekModel;
use App\Models\ClassSubjectTimetableModel; 
use Auth;
class ClassTimetableController extends Controller
{
    public function list(Request $request){
         $data['getClass']= ClassModel::getClass();
         if (!empty($request->class_id)) {
         $data['getrecords']= ClassSubejctModel::mySubject($request->class_id);
         }
 
         $getWeek = WeekModel::getrecords();
         $week = array();
         foreach($getWeek as $value) {
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;
            if (!empty($request->class_id) && !empty($request->subject_id)) {
               $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($request->class_id ,$request->subject_id, $value->id);
               if (!empty($ClassSubject)) {

                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
                $dataW['room_number'] = $ClassSubject->room_number;
                  
               }else{

            $dataW['start_time'] ='';
            $dataW['end_time'] = '';
            $dataW['room_number'] ='';
                  
               }
            }else{
                $dataW['start_time'] ='';
                $dataW['end_time'] = '';
                $dataW['room_number'] ='';
                    

            }
            $week[] = $dataW;

         }
         $data['week'] = $week;
        $data['head_title'] = 'Class Timet Table';
        return view("admin.class_timetable.list",$data);

    }

     public function get_subject(Request $request){
       $getrecords= ClassSubejctModel::getrecords($request->class_id);
       $html = "<option value = ''>Select</option>";
        
        foreach($getrecords as $subjects){
       $html .= "<option value = '".$subjects->subject_id."'>".$subjects->subject_name."</option>";

        }
        $json['html'] = $html;
        echo json_encode($json);
     }
    public function insert_update(Request $request){
        ClassSubjectTimetableModel::where('class_id','=',$request->class_id)->where('subject_id','=',$request->subject_id)->delete();
      foreach($request->timetable as $timetable){
        if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']) ) {
            $save = new ClassSubjectTimetableModel;
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->week_id = $timetable['week_id'];
            $save->start_time = $timetable['start_time'];
            $save->end_time = $timetable['end_time'];
            $save->room_number = $timetable['room_number'];
            $save->save();
        }

      }
      return redirect()->back()->with('success', 'successfully saved');
    
}
// Barataa side
public function MyTimetable()
{
    $result = array();
    $getrecords = ClassSubejctModel::mySubject(Auth::user()->class_id);

    foreach ($getrecords as $value) {
        $dataS = array();
        $dataS['name'] = $value->subject_name;

        $getWeek = WeekModel::getrecords();
        $week = array();

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($value->class_id, $value->subject_id, $valueW->id);

            if (!empty($ClassSubject)) {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
                $dataW['room_number'] = $ClassSubject->room_number;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }

            $week[] = $dataW;
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }

    $data['getrecords'] = $result;
    $data['head_title'] = 'My Timetable';

    return view("student.my_timetable", $data);
}
//teacher
public function MyTimetableTeacher($class_id, $subject_id){
        $data['getrecords'] = ClassModel::singlerecord($class_id);
        $data['getSubject'] = Subject::singlerecord($subject_id);
        $getWeek = WeekModel::getrecords();
        $week = array();

        foreach ($getWeek as $valueW) {
             $dataW = array();
             $dataW['week_name'] = $valueW->name;

             $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($class_id, $subject_id, $valueW->id);

            if (!empty($ClassSubject)) {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
                $dataW['room_number'] = $ClassSubject->room_number;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }

            $result[] = $dataW;
        }


     $data['getrecords'] = $result;    

    $data['head_title'] = 'My Timetable';

    return view("teacher.my_timetable", $data);

}

}
