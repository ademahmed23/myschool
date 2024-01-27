<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Subject extends Model
{
    use HasFactory;
    protected $table = "subjects";

    static function getrecords()
    {
       $request = Subject::select('subjects.*', 'users.name as create_by_name')
                            ->join('users', 'users.id', '=', 'subjects.created_by');
                            if(Request::get('name')){
                                $request->where('subjects.name','LIKE','%'.Request::get('name').'%');
                            }
                            if (Request::get('type')) {
                                $request->where('subjects.type', 'LIKE', '%' . Request::get('type') . '%');
                            }
                            if (Request::get('date')) { 
                                $request->where('subjects.created_at', 'LIKE', '%' . Request::get('date') . '%');
                            }    
                            $request= $request->where('subjects.is_delete','=',0)
                            ->orderBy('subjects.id', 'desc')
                            ->paginate(10);
        return $request;        
    }
    static function singlerecord($id)
    {
        return self::find($id);
    }

    static function SubjectGetrecords()
    {       
        $request = Subject::select('subjects.*', )
            ->join('users', 'users.id', 'subjects.created_by')
            ->where('subjects.is_delete', '=', 0)
            ->where('subjects.status', '=', 0)
            ->orderBy('Subjects.name', 'asc')
            ->get();
            return $request;
    }




}
