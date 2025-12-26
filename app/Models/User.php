<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static function getsingle($id)
    {
        return self::find($id);
    }

    static function getrcords()
    {
        $request = User::select('users.*')
                ->where('user_type', '=', 1)
                ->where('is_delete', '=', 0);
               
        if (!empty(Request::get('email'))){
            $request = $request->where('email','LIKE','%'. Request::get('email') .'%');
        }
        if (!empty(Request::get('name'))){
            $request = $request->where('name','LIKE','%'. Request::get('name') .'%');
        }
        if (!empty(Request::get('date'))){
            $request = $request->wheredate('created_at','=',Request::get('date'));
        }
        $request = $request->orderBy('id', 'desc')
                            ->paginate(10);
        return $request;

    }
    static function getTeacher()
    {
        $request = User::select('users.*')
        ->where('is_delete', '=', 0)
        ->where('user_type', '=', 2);
        $request = $request->orderBy('id', 'desc')
       ->paginate(4);
                                  
        return $request;

    }
      static function getTeacherClass()
    {
        $request = self::select('users.*')
          ->where('user_type', '=', 2)
        ->where('is_delete', '=', 0);
      
        $request = $request->orderBy('id', 'desc')
       ->get();
                                  
        return $request;

    } 

    public static function getTeacherStudent($teacher_id){
$request = self::select('users.*','class.name as class_name')
        ->join('users as parent','parent.id','=','users.parent_id','left')
        ->join('class','class.id','=','users.class_id','left')
        ->join('assign_class_teacher','assign_class_teacher.class_id','=','class.id')
          ->where('assign_class_teacher.teacher_id','=',$teacher_id)
       ->where('users.user_type', '=', 3)
        ->where('users.is_delete','=',0)

      

        ->where('class.is_delete','=',0);
        $request = $request->orderBy('id', 'asc')
       ->paginate(4);

        return $request;
    }

    static function getStudent()
    {
        $request = self::select('users.*','class.name as class_name','parent.name as parent_name', 'parent.last_name as parent_last_name')
        ->join('users as parent','parent.id','=','users.parent_id','left')
        ->join('class','class.id','=','users.class_id','left')
       ->where('users.user_type', '=', 3)
        ->where('users.is_delete','=',0);

        if (!empty(Request::get('email'))){
            $request = $request->where('users.email','LIKE','%'. Request::get('email') .'%');
        }
        if (!empty(Request::get('name'))){
            $request = $request->where('users.name','LIKE','%'. Request::get('name') .'%');
        }
        if (!empty(Request::get('date'))){
            $request = $request->wheredate('created_at','=',Request::get('date'));
        }

        $request= $request->where('class.is_delete','=',0);
        $request = $request->orderBy('id', 'asc')
       ->paginate(4);

        return $request;
 
    }
   public static function getSearchStudent(){
   // dd(Request::all());
       if (!empty(Request::get('id')) || !empty(Request::get('name')) 
     ||!empty(Request ::get('last_name')) || !empty(Request::get('email'))) {
            
            $request = User::select('users.*','class.name as class_name','parent.name as parent_name')
            ->join('users as parent','parent.id','=','users.parent_id','left')
            ->join('class','class.id','=','users.class_id','left')
            ->where('users.user_type', '=', 3)
           ->where('users.is_delete','=',0);
            if(!empty(Request :: get('id'))){
                $request = $request->where('users.id','=',Request::get('id').'%');
            }
            if(!empty(Request :: get('name'))){
                $request = $request->where('users.name','like','%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))){
                $request = $request->where('users.last_name','like','%'. Request::get('last_name') .'%');
            }
            if (!empty(Request::get('email'))){
                $request = $request->where('users.email','like','%'. Request::get('email') .'%');
            }
          
            $request = $request->orderBy('id', 'desc')
            ->limit(100)
            ->get();
     return $request;
    
     }}
  
    static function getParent()
    {
        $request = User::select('users.*')
                ->where('user_type', '=', 4)
                ->where('is_delete', '=', 0);
        $request = $request->orderBy('id', 'desc')
                            ->paginate(3);
        return $request;

    }
    static function search($id)
    {
 
        $request=User::find($id);
        return $request;
    
    }
    static function getMyStudent($parent_id){
         $request = User::select('users.*','class.name as class_name','parent.name as parent_name')
            ->join('users as parent','parent.id','=','users.parent_id','left')
            ->join('class','class.id','=','users.class_id','left')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
           ->where('users.is_delete','=',0)

        //   //  if(!empty(Request :: get('id'))){
        //        /* $request = $request->where('users.id','=',Request::get('id').'%');
        //     }
        //     if(!empty(Request :: get('name'))){
        //         $request = $request->where('users.name','like','%'.Request::get('name').'%');
        //     }
        //     if (!empty(Request::get('last_name'))){
        //         $request = $request->where('users.last_name','like','%'. Request::get('last_name') .'%');
        //     }
        //     if (!empty(Request::get('email'))){
        //         $request = $request->where('users.email','like','%'. Request::get('email') .'%');
        //     }*/
          
            ->orderBy('id', 'desc')
            ->get();
     return $request;

    }
    
    static function getemailsigle($email)
    {
     return User::where('email','=',$email)->first();
    }

    static function edit($id)
    {
     return User::where('id','=',$id)->first();
    }
    public function getProfile(){
        if (!empty($this ->profile_picture)&&file_exists('uploads/profiles/'.$this->profile_picture)) {
            return url('uploads/profiles/'.$this->profile_picture);
        }else {
                return "";
            }


        }
 static function getStudentClass($class_id)
    {
       return self::select('users.id','users.name', 'users.last_name')
       ->where('users.user_type', '=', 3)
       ->where('users.class_id', '=', $class_id)
        ->where('users.is_delete','=',0)
        ->orderBy('users.id','desc')
        ->get();

       
       

        
 
    }
    }