<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignClassTeachermodel extends Model
{
    use HasFactory;
   protected $table = 'assign_class_teacher';
    static function getAlreadyfirst($class_id, $teacher_id)
    {
       return self::where('class_id', '=', $class_id)
            ->where('teacher_id', '=', $teacher_id)
            ->first();
        

    }
    static function getsingle($id){
        return self::find($id);

    }
    static function getrecord()
    {
    $request= self::Select('assign_class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name','teacher.last_name as teacher_last_name', 'users.name as create_by_name')
            ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
            ->join('users as teacher', 'teacher.id', '=', 'assign_class_teacher.teacher_id')
            ->join('users', 'users.id', '=', 'assign_class_teacher.created_by');
    $request= $request->where('assign_class_teacher.is_delete','=',0)
            ->orderby('assign_class_teacher.id','desc')
            ->paginate(3);

        return $request;
    }
      static function getAssignTeacherID($class_id)
    {
      return self::where('class_id',$class_id)
                    ->where('is_delete','=',0)
                    ->get();
       
    }
     static function deleteTeacher($class_id, $teacher_id)
    {
        return self::where('class_id', $class_id)
            ->where('teacher_id', $teacher_id)
            ->delete();
    }
    static function getMyClassSubject($teacher_id){

return AssignClassTeachermodel::Select('assign_class_teacher.*', 'class.name as class_name','subjects.name as subject_name','subjects.type as subjects_type','class.id as class_id','subjects.id as subject_id')
             ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
             ->join('class_subjects','class_subjects.class_id','=','class.id')
             ->join('subjects','subjects.id','=','class_subjects.subject_id')
              ->where('assign_class_teacher.status','=',0)
              ->where('subjects.status','=',0)
              ->where('subjects.is_delete','=',0)
              ->where('class_subjects.status','=',0)
              ->where('class_subjects.is_delete','=',0)


            ->where('assign_class_teacher.is_delete','=',0)
            ->where('assign_class_teacher.status','=',0)
            ->where('assign_class_teacher.teacher_id','=',$teacher_id)
            ->get();
    }
      static function getMyClassSubjectGroup($teacher_id){

return AssignClassTeachermodel::Select('assign_class_teacher.*', 'class.name as class_name','class.id as class_id')
             ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
             ->join('class_subjects','class_subjects.class_id','=','class.id')
             ->join('subjects','subjects.id','=','class_subjects.subject_id')
              ->where('subjects.status','=',0)
              ->where('subjects.is_delete','=',0)
              

            ->where('assign_class_teacher.is_delete','=',0)
            ->where('assign_class_teacher.status','=',0)
            ->where('assign_class_teacher.teacher_id','=',$teacher_id)
            ->groupBy('assign_class_teacher.class_id')
            ->get();
    }
    static function getMyTimetable($class_id,$subject_id){
        $getWeek = WeekModel::getWeekusingName(date('l'));
                  return ClassSubjectTimetableModel::getRecordClassSubject($class_id, $subject_id, $getWeek->id);



    }
    static function getCalendarTeacher($teacher_id){
        return AssignClassTeachermodel::Select('class_subject_timetable.*', 'class.name as class_name','subjects.name as subject_name','week.name as week_name','week.fullcalendar_day')
        ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
         ->join('class_subjects', 'class_subjects.class_id', '=', 'class.id')
         ->join('class_subject_timetable', 'class_subject_timetable.subject_id', '=', 'class_subjects.subject_id')
         ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
         ->join('week', 'week.id', '=', 'class_subject_timetable.week_id')
           ->where('assign_class_teacher.teacher_id','=',$teacher_id)
           ->where('assign_class_teacher.status','=', 0)
           ->where('assign_class_teacher.is_delete','=', 0)
           ->get();
    }

}
