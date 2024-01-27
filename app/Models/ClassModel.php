<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';
    protected $fillable = ['name','status'];

    static function getrecords()
    {
        $request = ClassModel::select('class.*', 'users.name as create_by_name')
                            ->join('users', 'users.id', '=', 'class.create_by');
                            if(!empty(Request::get('name'))){
                                $request=$request->where('class.name','like','%'.Request::get('name').'%');
                            }
                            if(!empty(Request::get('date'))){
                                $request=$request->whereDate('class.created_at','like','%'.Request::get('date').'%');
                            }
                           $request= $request->where('class.is_delete','=',0)
                            ->orderBy('class.id', 'desc')
                            ->paginate(2);
        return $request;
    }
    static function singlerecord($id)
    {
        return self::find($id);
       
    }

    static function ClassGetrecords()
    {
        $request = ClassModel::select('class.*', )
            ->join('users', 'users.id', 'class.create_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'desc')
            ->get();
        return $request;
    }



    static function getClass()
    {
        $request = ClassModel::select('class.*', )
            ->join('users', 'users.id', 'class.create_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();
        return $request;
    }
}