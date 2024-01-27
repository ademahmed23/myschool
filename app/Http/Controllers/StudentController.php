<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;


class StudentController extends Controller
{
 public function list_student()
    {
        $data['getrecords'] = User::getStudent();
        $data['header_title']= 'Student list';
        return view('admin.student.list',$data);
     }


    public function add_student()
    {
      $data['getClass'] = ClassModel::getClass();
      $data['header_title'] = "Add New Student";
            return view('admin.student.add',$data);


        }
        public function insert(Request $request){
            request()->validate([
                'name' => 'required',
               'email' => 'required|email|unique:users',
               
               'blood_group' =>   'max:10',
               
               'mobile_number'=> 'max:15|min:8',
              'nation' => 'max:20',
             'address'  => 'max:255',
             'religion'  => 'max:50',
             'admission_number' => 'max:50'



           ]);
            //dd($request->all());
           $student = new User;
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
             if(!empty($request->admission_date)){
          $student->admission_date=trim($request->admission_date);
         }

           
            if(!empty($request->file('profile_picture')))
            {
                $ext= $request-> file('profile_picture')->getClientOriginalExtension();
                $file = $request->file('profile_picture');
                $randomStr = date('dmY').Str::random(40);
                $filename =strtolower($randomStr).'.'.$ext;
                $file->move('uploads/profiles/',$filename);
                $student->profile_picture = $filename;
            }
            $student->nation=trim($request->nation);
            $student->religion=trim($request->religion);
            if(!empty($request->admission_date)){
                $student->admission_date=trim($request->admission_date);

                }
            $student->blood_group=trim($request->blood_group);
            $student->height=trim($request->height);
            $student->weight=trim($request->weight);
            $student->status=trim($request->status);
            $student->email=trim($request->email);
            $student->password=Hash::make($request->password);
            $student-> user_type = 3;
            $student->save();
return redirect('admin/student/list')->with('success','student successfully registered ');

          }
          public function edit($id){
           //dd($id);
            $data['getrecords'] = User::getsingle($id);
            if (!empty($data['getrecords'])) {

                $data['getClass'] = ClassModel::getClass();
                $data['header_title'] = "Edit Student";
                return view('admin.student.edit',$data);
            }
           else {
            abort(404);
           }

          }
        public function update($id,Request $request){

            request()->validate([
               'email' => 'required|email|unique:users,email,'.$id,
               'blood_group' =>   'max:10',
               'mobile_number'=> 'max:15|min:8',
              'nation' => 'max:20',
             'address'  => 'max:255',
             'religion'  => 'max:50',
             'admission_number' => 'max:50'


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
           if(!empty($request->admission_date)){
          $student->admission_date=trim($request->admission_date);
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
            if(!empty($request->admission_date)){
                $student->admission_date=trim($request->admission_date);

                }
            $student->blood_group=trim($request->blood_group);
            $student->height=trim($request->height);
            $student->weight=trim($request->weight);
            $student->status=trim($request->status);
            $student->email=trim($request->email);
            if (!empty($request->password)) {

            $student->password=Hash::make($request->password);
            }

            $student->save();
return redirect('admin/student/list')->with('success','student successfully updated ');

        }
       public function delete($id){
        $getrecords = User::getsingle($id);
        if (!empty($getrecords)) {

            $getrecords-> is_delete=1;
            $getrecords->save();
return redirect()->back()->with('success','student successfully Deleted ');

        }
       else {
        abort(404);
       }
       }
       public function myStudent(){
         $data['getrecords'] = User::getTeacherStudent(Auth::user()->id);
        $data['header_title']= 'My Student';
        return view('teacher.my_student',$data);
       }
        }