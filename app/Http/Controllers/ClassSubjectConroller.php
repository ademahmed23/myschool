<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubejctModel;
use App\Models\Subject;
use App\Models\ClassModel;
use Auth;

class ClassSubjectConroller extends Controller
{
    public function list()
    {
        $data['getrecords'] = ClassSubejctModel::getrecords();
        // dd($data['getrecords']);
        $data['head_title']= 'Class list';
        return view('admin.assign_subject.list',$data);
    }

    public function add()
    {
        $data['ClassGetrecords'] = ClassModel::ClassGetrecords();
        $data['SubjectGetrecords'] =Subject::SubjectGetrecords();
        $data['head_title'] = 'Add Class';
        return view('admin.assign_subject.add',$data);
    }
    public function insert(Request $request)
    {
        if(!empty($request->subject_id)){
            foreach ($request->subject_id as $subject_id) {
                $getAlreadyfirst=ClassSubejctModel::getAlreadyfirst($request->class_id,$subject_id);
                if (!empty($getAlreadyfirst)) {
                    $getAlreadyfirst->status = $request->status;
                    $getAlreadyfirst->save();
                }else {
                    $save = new ClassSubejctModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->created_by = Auth::user()->id;
                    $save->status = $request->status;
                    $save->save();
                }
            }
            return redirect()->route('assign_subject.list')->with('success', 'New Assign Subject Add Successfully');

            }else{

            return redirect()->route('assign_subject.list')->with('errors', 'Due to Some Errors, Please try agen.');
        }
    }
    public function edit($id)
    {
        $getrecord= ClassSubejctModel::singlerecord($id);
        if(!empty($getrecord)) {
            $data['getrecord'] = $getrecord;
            $data['getAssignSubjectID'] = ClassSubejctModel::getAssignSubjectID($getrecord->class_id);
            // dd($data['getAssignSubjectID']);
            $data['getClass'] = ClassModel::ClassGetrecords();
            $data['getSubject'] =Subject::SubjectGetrecords();
            $data['head_title'] = 'Edit Class';
            // dd($data);
            return view('admin.assign_subject.edit',$data);
        }else{
            abort(404);
        }

    }

    public function update(Request $request)
    {
        // dd($request);
         ClassSubejctModel::deleteBySubject($request->class_id,$request->subject_id);
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlreadyfirst = ClassSubejctModel::getAlreadyfirst($request->class_id, $subject_id);
                if (!empty($getAlreadyfirst)) {
                    $getAlreadyfirst->status = $request->status;
                    $getAlreadyfirst->save();
                } else {
                    $save = new ClassSubejctModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->created_by = Auth::user()->id;
                    $save->status = $request->status;
                    $save->save();
                }
            }
        }
        return redirect()->route('assign_subject.list')->with('success', 'Update Assign Subject Add Successfully');

    }

        public function delete($id)
    {
        $save= ClassSubejctModel::singlerecord($id);

        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with('success', 'Class Deleted Successfully');
    }

    public function single_edit($id)
    {
        $getrecord= ClassSubejctModel::singlerecord($id);
        if(!empty($getrecord)) {
            $data['getrecord'] = $getrecord;
            // dd($data['getAssignSubjectID']);
            $data['getClass'] = ClassModel::ClassGetrecords();
            $data['getSubject'] =Subject::SubjectGetrecords();
            $data['head_title'] = 'Edit Single Record';
            //dd($data);
            return view('admin.assign_subject.single_edit',$data);
        }else{
            abort(404);
        }
    }

    public function single_update($id,Request $request)
    {
        $getAlreadyfirst = ClassSubejctModel::getAlreadyfirst($request->class_id, $request->subject_id);
        if (!empty($getAlreadyfirst))
        {
            $getAlreadyfirst->status = $request->status;
            $getAlreadyfirst->save();
            return redirect()->route('assign_subject.list')->with('success','Status update Successfully');
        } else {
            $save = ClassSubejctModel::singlerecord($id);
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->status = $request->status;
            $save->save();
        }
        return redirect()->route('assign_subject.list')->with('success', 'Update Assign Subject Add Successfully');
    }
}
