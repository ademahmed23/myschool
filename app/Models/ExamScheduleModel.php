<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleModel extends Model
{
    use HasFactory;
    protected $table='exam_schedule';
    static function getsingle($exam_id, $class_id, $subject_id)
    {

        return self::where('exam_id','=',$exam_id)->where('class_id','=',$class_id)->where('subject_id','=',$subject_id)->first();

    } 
    static function getSingleID($id){
return self::find($id);
    }
    static function deleteRecord($exam_id,$class_id){
        ExamScheduleModel::where('exam_id','=',$exam_id)->where('class_id','=',$class_id)->delete();

    }
    static function getExam($class_id){

return ExamScheduleModel::select('exam_schedule.*','exam.name as exam_name')
->join('exam','exam.id','=','exam_schedule.exam_id')
->where('exam_schedule.class_id','=',$class_id)
->groupBy('exam_schedule.exam_id')
->orderBy('exam_schedule.id','desc')
->get();

    }
    static function getExamTeacher($teacher_id){

return ExamScheduleModel::select('exam_schedule.*','exam.name as exam_name')
->join('exam','exam.id','=','exam_schedule.exam_id')
->join('assign_class_teacher','assign_class_teacher.class_id','=','exam_schedule.class_id')
->where('assign_class_teacher.teacher_id','=',$teacher_id)
->groupBy('exam_schedule.exam_id')
->orderBy('exam_schedule.id','desc')
->get();

    }
    static function getExamTimetable($exam_id,$class_id){
        return ExamScheduleModel::select('exam_schedule.*','subjects.name as subject_name','subjects.type as subjects_type')
        ->join('subjects','subjects.id', '=','exam_schedule.subject_id')
->where('exam_schedule.exam_id','=',$exam_id)
->where('exam_schedule.class_id','=',$class_id)
->orderby('exam_schedule.id','desc')
->get();

    }
    static function getSubject($exam_id,$class_id){
        return ExamScheduleModel::select('exam_schedule.*','subjects.name as subject_name','subjects.type as subjects_type')
        ->join('subjects','subjects.id', '=','exam_schedule.subject_id')
->where('exam_schedule.exam_id','=',$exam_id)
->where('exam_schedule.class_id','=',$class_id)
->orderby('exam_schedule.id','desc')
->get();

    }
    static function getExamTimetableT($teacher_id){
        return self::select('exam_schedule.*', 'class.name as class_name','subjects.name as subject_name','exam.name as exam_name')
        ->join('assign_class_teacher','assign_class_teacher.class_id','=','exam_schedule.class_id')
         ->join('class', 'class.id', '=', 'exam_schedule.class_id')
            ->join('subjects', 'subjects.id', '=', 'exam_schedule.subject_id')
            ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
        ->where('assign_class_teacher.teacher_id','=',$teacher_id)
        ->get();


    }
    static function getMark($student_id, $exam_id, $class_id, $subject_id){
        return MarkRegisteringModel::checkAlreayMark($student_id, $exam_id, $class_id, $subject_id);

    }

}
