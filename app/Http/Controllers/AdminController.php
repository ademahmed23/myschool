<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    public function add_list()
    {
        $data['getrecords'] = User::getrcords();
        // echo "<pre>";
        // print_r( $data['getrecords']);
        // echo "</pre>";
        $data['header_title']= 'Admin list';
        return view('admin.admin.list',$data);
         //dd($data['getrecords']);
    }


    public function add_admin()
    {
        return view('admin.admin.add_admin');
    }

    public function adinsert(request $request){
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->user_type = 1;
        $users-> save();
        return redirect()->route('admin.admin.add_list')->with('success', 'New Admin register successfully.');

    }

    public function edit($id) 
    {
        $data['records'] = User::edit($id);
        if(!empty($data['records'])) {
            $data['head_title'] = 'Edit Admin   ';
            return view('admin.admin.edit_admin', $data);
        }else{
            abort(404);
        }

    }

    public function update(request $request, $id)
    {    request()->validate([
             'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        $users =User::edit($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->user_type = 1;
        $users->save();
        return redirect()->route('admin.add_list')->with('success', 'New Admin update successfully.');

    }
    public function delete($id)
    {
        $users = User::edit($id);
        $users->is_delete = 1;
        $users->save();
        return redirect()->route('admin.add_list')->with('success', 'Delete Admin Record Successfully.');

    }

    public function search()
    {
        dd($_GET);
        $users =  User::search();
    }


}