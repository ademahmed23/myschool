<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassSubejctModel;
use App\Models\SubjectModel;
use Auth;
use Mockery\Generator\StringManipulation\Pass\ClassPass;

class ClassController extends Controller
{
    public function add_list()
    {
        $data['getrecords'] = ClassModel::getrecords();

        $data['head_title']= 'Class list';
        return view("admin.class.list",$data);


    }

    public function add_class()
    {
        $data['head_title'] = 'Add Class';
        return view('admin/class/add',$data);
    }
    public function add_insert(Request $request)
    {
        Request()->validate([
            'name'
        ]);
        $class = new ClassModel;
        $class->name = $request->name;
        $class->status = $request->status;
        $class->create_by = Auth::user()->id;
        $class->save();
        return redirect()->route('add_list')->with('success', 'New Class add Successfully');
    }

    public function edit($id)
    {
        $data['getrecords'] = ClassModel::singlerecord($id);
        if(!empty($data['getrecords']))
        {
            $data['head_title'] = 'Edit Class';
            return view('admin.class.edit',$data);
        }else{
            abort(404);
        }
    }
    public function update($id, Request $request)
    {
        $save= ClassModel::singlerecord($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();
        return redirect('admin/class/list')->with('success', 'Update Class Sucessfully');
    }
    public function delete($id)
    {
        $save= ClassModel::singlerecord($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with('success', 'Class Deleted Successfully');
    }
}
