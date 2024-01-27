<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkRegisteringModel extends Model
{
    use HasFactory;
    protected $table =  'mark_registering';
    static public function checkAlreayMark($student_id, $exam_id, $class_id, $subject_id){
    return self ::where('student_id','=',$student_id)->where('exam_id','=',$exam_id)->where('class_id','=',$class_id)->where('subject_id','=',$subject_id)->first();

    }
    static function getExam($student_id){

return MarkRegisteringModel::select('mark_registering.*','exam.name as exam_name')

->join('exam','exam.id','=','mark_registering.exam_id')
->where('mark_registering.student_id','=', $student_id)
->groupBy('mark_registering.exam_id')
->get();
    }
    static function getExamSubject($exam_id, $student_id){
       return MarkRegisteringModel::select('mark_registering.*','exam.name as exam_name','subjects.name as subject_name')

->join('exam','exam.id','=','mark_registering.exam_id')
->join('subjects','subjects.id','=','mark_registering.subject_id')


->where('mark_registering.exam_id','=', $exam_id)
->where('mark_registering.student_id','=', $student_id)
->get();
    }
}
