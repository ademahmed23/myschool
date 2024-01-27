<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ExamModel extends Model
{
    use HasFactory;
    protected $table = 'exam';
    static function getsingle($id){
        return self::find($id);

    }
    static function getrecord(){
        $request = self::Select('exam.*', 'users.name as created_name')
        ->join('users','users.id','=','exam.created_by');
        if (!empty(Request::get('name'))) {
       $request = $request->where('exam.name', 'like','%'.Request::get('name').'%');
            
        }
          if (!empty(Request::get('date'))) {
       $request = $request->wheredate('exam.created_at', '=', Request::get('date'));
            
        }
       $request = $request->where('exam.is_delete', '=', 0)
        ->orderby('exam.id','asc')
        ->paginate(3);
        return $request;
    }
     static function getExam(){
     return self::Select('exam.*')
        ->join('users','users.id','=','exam.created_by')
        ->where('exam.is_delete', '=', 0)
        ->orderby('exam.name','asc')
        ->get();
       
    }


}
