<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassSubejctModel;

use Auth;

class SubjectConroller extends Controller
{
    public function list()
    {
        $data['getrecords']= Subject::getrecords();
        $data['head_title'] = 'Subject list';
        return view("admin.subject.list",$data);
    }
    public function add(Request $request)
    {
        $data['head_title'] = 'Add subject';
        return view("admin/subject/add",$data);
    }

    public function insert(Request $request)
    {

        $subject = new Subject;
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->created_by = Auth::user()->id;
        $subject->save();
        return redirect()->route('subject.list')->with('success', 'New Class add Successfully');
    }
     public function edit($id)
    {
        $data['getrecords'] = Subject::singlerecord($id);
        if(!empty($data['getrecords']))
        {
            $data['head_title'] = 'Edit Subject';
            return view('admin.subject.edit',$data);
        }else{
            abort(404);
        }
    }
     public function update($id, Request $request)
    {
        $save= Subject::singlerecord($id);
        $save->name = $request->name;
        $save->type = $request->type;
        $save->status = $request->status;
        $save->save();
        return redirect('admin/subject/list')->with('success', 'Update Subject Sucessfully');
    }
     public function delete($id)
    {
        $save= Subject::singlerecord($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with('success', 'Subject Deleted Successfully');
    }
    public function mySubject(){
        //dd(Auth::user()->class_id);
        $data['getrecords']= ClassSubejctModel::mySubject(Auth::user()->class_id);
        $data['head_title'] = 'My Subject';
        return view("student.my_subject",$data);
    }
}
