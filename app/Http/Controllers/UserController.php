<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Str;

class UserController extends Controller

{
    
    public function myAccount(){
        $data['getrecords'] = User::getsingle(Auth::user()->id);
        $data['header_title'] = "account";
        if (Auth::user()->user_type==1) {

            return view('admin.admin.my_account',$data);

            // code...
        }
        if (Auth::user()->user_type==2) {

return view('teacher.my_account', $data);
        
 $data['getrecords'] = User::getsingle(Auth::user()->id);
        $data['header_title'] = "myAccount";
        }elseif (Auth::user()->user_type==3) {

            return view('student.my_account',$data);

            // code...
        }
        elseif(Auth::user()->user_type==4){
            $data['getrecords'] = User::getsingle(Auth::user()->id);
        $data['header_title'] = "account";
            return view('parent.my_account');
        }
    }
     public function UpdatemyAccountAdmin(Request $request)
{
 $student = User::getsingle($id);
            $admin->name=trim($request->name);
            $admin->last_name=trim($request->last_name);
            $admin->email=trim($request->email);
}   public function UpdatemyAccountStudent(Request $request){
  $id =Auth::user()->id;
    request()->validate([
               'email' => 'required|email|unique:users,email,'.$id,
               'blood_group' =>   'max:10',
               'mobile_number'=> 'max:15|min:8',
              'nation' => 'max:20',
             'address'  => 'max:255',
             'religion'  => 'max:50',
            


           ]);
            //dd($request->all());
           $student = User::getsingle($id);
            $student->name=trim($request->name);
            $student->last_name=trim($request->last_name);
            $student->admission_number=trim($request->admission_number);
            $student->roll_number=trim($request->roll_number);
            $student->class_id=trim($request->class_id);
            $student->gender=trim($request->gender);
            $student->mobile_number=trim($request->mobile_number);
            if(!empty($request->date_of_birth)){
            $student->date_of_birth=trim($request->date_of_birth);
            } 
            
           if (!empty($request->profile_picture)) {
            # code...
           }
            if(!empty($request->file('profile_picture')))
            {
                if (!empty($student->getProfile())) {
                    unlink('uploads/profiles/'.$student-> profile_picture);

                    # code...
                }
                $ext= $request-> file('profile_picture')->getClientOriginalExtension();
                $file = $request->file('profile_picture');
                $randomStr = date('Ymdhis').Str::random(40);
                $filename =strtolower($randomStr).'.'.$ext;
                $file->move('uploads/profiles/',$filename);
                $student->profile_picture = $filename;
            }
            $student->nation=trim($request->nation);
            $student->religion=trim($request->religion);
            $student->blood_group=trim($request->blood_group);
            $student->height=trim($request->height);
            $student->weight=trim($request->weight);
            
            

            $student->save();
return redirect()->back()->with('success','student successfully updated ');
         }
         public function UpdatemyAccountParent(Request $request){
 $data['getrecords'] = User::getsingle(Auth::user()->id);

           return view('parent/account');
         }
          public function UpdatemyAccountTeacher(Request $request){
            $id=Auth::user()->id;


          }

    public function change_password()
    {
        $data['head_title'] = " Change Password";
        return view("",$data);
    }
   
    public function update_password(Request $request)
    {
        $user =User::getsingle(Auth::user()->id);
         dd($user);
        if(Hash::check($request->old_password,$user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with("success","New Password Submited Successfully");
        }else{
            return redirect()->back()->with("error","Password Dose Not Match");
        }

    }


}
