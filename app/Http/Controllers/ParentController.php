<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;

use Hash;
use Auth;
use Str;


class ParentController extends Controller
{
    public function list()
    {
        $data['getrecords'] = User::getParent();
        $data['header_title'] = 'Parent list';
        return view('admin.parent.list', $data);
        dd($data['getrecords']);
    }

    public function add()
    {
        $data['header_title'] = "Add New Parent";
        return view('admin.parent.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
            'address' => 'max:100',
            'occupation' => 'max:100',
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->occupation = trim($request->occupation);
        $student->address = trim($request->address);

        if (!empty($request->profile_picture)) {
            // Code for handling profile picture
        }

        if (!empty($request->file('profile_picture'))) {
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis') . Str::random(40);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('uploads/profiles/', $filename);
            $student->profile_picture = $filename;
        }

        $student->mobile_number = trim($request->mobile_number);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 4;
        $student->save();

        return redirect('admin/parent/list')->with('success', 'parent successfully registered ');
    }

    public function edit($id)
    {
        $data['getrecords'] = User::getsingle($id);
        if (!empty($data['getrecords'])) {
            $data['header_title'] = "Edit parent";
            return view('admin.parent.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
            'address' => 'max:100',
            'occupation' => 'max:100',
        ]);

        $student = User::getsingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->occupation = trim($request->occupation);
        $student->address = trim($request->address);

        if (!empty($request->profile_picture)) {
            // Code for handling profile picture
        }

        if (!empty($request->file('profile_picture'))) {
            if (!empty($student->getProfile())) {
                unlink('uploads/profiles/' . $student->profile_picture);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis') . Str::random(40);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('uploads/profiles/', $filename);
            $student->profile_picture = $filename;
        }

        $student->mobile_number = trim($request->mobile_number);
        $student->status = trim($request->status);
        $student->email = trim($request->email);

        if (!empty($request->password)) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect('admin/parent/list')->with('success', 'parent successfully updated ');
    }

    public function delete($id)
    {
        $getrecords = User::getsingle($id);
        if (!empty($getrecords)) {
            $getrecords->is_delete = 1;
            $getrecords->save();
            return redirect()->back()->with('success', 'parent successfully Deleted ');
        } else {
            abort(404);
    
    

    



   }
   }
   public function myStudent($id){
    $data['getParent'] = User::getsingle($id);
    $data['parent_id'] =$id;
    $data['getSearchStudent'] = User::getSearchStudent();
    $data['getrecords'] = User::getMyStudent($id);

        $data['header_title']= 'Parent Student List';
        return view('admin.parent.my_student',$data);
        
   }
   public function AssignStudentParent($student_id, $parent_id){
    $student = User::getsingle($student_id);
    $student-> parent_id = $parent_id;
    $student->save();
    return redirect()->back()->with('success', "Student successfully Assigned");
   }
   public function AssignStudentParentDelete($student_id){
    $student = User::getSingle($student_id); 
     $student->parent_id = null;
    $student->save();
    return redirect()->back()->with('success', "Student successfully Assign Deleted");
   }
   public function myStudentParent(){
    $id = Auth::user()->id;
    $data['getrecords'] = User::getMyStudent($id);
        $data['header_title']= 'Parent Student List';
        return view('parent.my_student',$data);
   }
}