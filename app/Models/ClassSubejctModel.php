<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Request;

class ClassSubejctModel extends Model
{
    use HasFactory;
    protected $table = 'class_subjects';
    static function getrecords()
    {
        $request = self::Select('class_subjects.*', 'class.name as class_name', 'subjects.name as subject_name', 'users.name as create_by_name')
            ->join('class', 'class.id', '=', 'class_subjects.class_id')
            ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
            ->join('users', 'users.id', '=', 'class_subjects.created_by');
            if(!empty(Request::get('class_name'))){
                $request=$request->where('class.name','like','%'.Request::get('class_name').'%');
            }
            if(!empty(Request::get('subject_name'))){
                $request=$request->where('subjects.name','like','%'.Request::get('subject_name').'%');
            }
            if(!empty(Request::get('date'))){
                $request=$request->where('class_subjects.created_at','like','%'.Request::get('date').'%');
            }

    $request= $request->where('class_subjects.is_delete','=',0)
            ->orderby('class_subjects.id','desc')
            ->paginate(10);

        return $request;
    }
   
    static function singlerecord($id)
    {
        $request=ClassSubejctModel::find($id);
        return $request;
    }


    static function getAlreadyfirst($class_id,$subject_id)
    {
        $request = self::where('class_id', '=', $class_id)
            ->where('subject_id', '=', $subject_id)
            ->first();
        return $request;

    }
   
 static public function mySubject($class_id){
      return self::Select('class_subjects.*', 'subjects.name as subject_name')
            ->join('class', 'class.id', '=', 'class_subjects.class_id')
            ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
            ->join('users', 'users.id', '=', 'class_subjects.created_by')

        ->where('class_subjects.class_id', '=', $class_id)
      ->where('class_subjects.is_delete','=',0)
         ->where('class_subjects.status','=',0)
 
            ->orderby('class_subjects.id','desc')
            ->get();
    }
   public static function deleteBySubject($class_id, $subject_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->delete();
    }

 static function getAssignSubjectID($class_id)
    {
        $request=self::where('class_id',$class_id)
                    ->where('is_delete','=',0)
                    ->get();
        return $request;
    }

}
