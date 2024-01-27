<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\AssignClassTeacherModel;
use Auth;

 
class AssignClassTeacherController extends Controller
{
    public function list(Request $request){
        $data['getrecord'] = AssignClassTeacherModel::getrecord();

        // dd($data['getrecords']);
        $data['head_title']= 'Assign Class Teacher';
        return view('admin/assign_class_teacher/list',$data);
    }
    public function add(Request $request)

    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();

        $data['head_title']= 'Assign New Class Teacher';
        return view('admin.assign_class_teacher.add',$data);
    }
    public function insert(Request $request){
if(!empty($request->teacher_id)){
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyfirst=AssignClassTeacherModel::getAlreadyfirst($request->class_id,$teacher_id);
                if (!empty($getAlreadyfirst)) {
                    $getAlreadyfirst->status = $request->status;
                    $getAlreadyfirst->save();
                }else {
                    $save = new AssignClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->created_by = Auth::user()->id;
                    $save->status = $request->status;
                    $save->save();
                }
            }
            return redirect('admin/assign_class_teacher/list')->with('success', 'New Assign class to Teacher Successfully');

            }else{

            return redirect()->back()->with('errors', 'Due to Some Errors, Please try agen.');
        }
    }
    
    public function edit($id){

 $getrecord= AssignClassTeacherModel::getsingle($id);
        if(!empty($getrecord)) {
            $data['getrecord'] = $getrecord;
            $data['getAssignTeacherID'] = AssignClassTeacherModel::getAssignTeacherID($getrecord->class_id);
           // dd($data['getAssignTeacherID']);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] =User::getTeacherClass();
            $data['head_title'] = 'Edit Assign  Class Teacher';
            // dd($data);
            return view('admin.assign_class_teacher.edit',$data);
        }else{
            abort(404);
        }

    }
   public function update($id, Request $request)
    {
         //dd($request->all());
    return AssignClassTeacherModel::deleteTeacher($request->class_id,$request->teacher_id);
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyfirst = AssignClassTeacherModel::getAlreadyfirst($request->class_id, $teacher_id);
                if (!empty($getAlreadyfirst)) {
                    $getAlreadyfirst->status = $request->status;
                    $getAlreadyfirst->save();
                } else {
                    $save = new AssignClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $subject_id;
                    $save->created_by = Auth::user()->id;
                    $save->status = $request->status;
                    $save->save();
                }
            }
        }
        return redirect('admin/assign_class_teacher/list')->with('success', 'Update Assign Subject Add Successfully');

    }
    public function edit_single(Request $id){
        $getrecord= AssignClassTeacherModel::getsingle($id);
        if(!empty($getrecord)) {
            $data['getrecord'] = $getrecord;
            //$data['getAssignTeacherID'] = AssignClassTeacherModel::getAssignTeacherID($getrecord->class_id);
            // dd($data['getAssignSubjectID']);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] =User::getTeacherClass();
            $data['head_title'] = 'Edit Assign  Class Teacher';
            // dd($data);
            return view('admin.assign_class_teacher.edit_single',$data);
        }else{
            abort(404);
        }
       
    }
public function MyClassSubject(){
    $data['getrecords']=AssignClassTeacherModel::getMyClassSubject(Auth::user()->id);
     $data['head_title'] = 'My Class & Subject';
 return view('teacher.my_class_subject',$data);



}}

  