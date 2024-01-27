 @extends('layouts.app')
 @section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">


     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">

             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Add New Admin</h1>
                         </div>
                         <div class="col-sm-6" style="text-align:right">
                             <a href="{{url('/admin/admin/list')}}" class="btn btn-primary">Back</a>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>


             <div class="row">
                 <div class="col-md-12">
                     <div class="card card-primary">
                         <form method="POST" action="{{Route('admin.add_insert')}}">
                             @csrf
                             <div class="card-body">
                                 <label for="validationCustom01" class="form-label">Name</label>
                                 <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                     id="validationCustom01" placeholder="Enter Name">
                                 <div style="color:red">{{$errors->first('name')}}</div>
                             </div>
                             <div class="card-body">
                                 <label>Email</label>
                                 <input type="email" class="form-control" name="email" value="{{old('email')}}"
                                     id="exampleInputEmail1" placeholder="Enter Email">
                                 <div style="color:red">{{$errors->first('email')}}</div>
                             </div>
                             <div class="card-body">
                                 <label>Password</label>
                                 <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                     placeholder="Password">
                                 <div style="color:red">{{$errors->first('password')}}</div>
                             </div>
                     </div>
                     <div class="card-footer">
                         <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                     </form>
                 </div>
             </div>
         </div>
 </div><!-- /.container-fluid -->
 </section>
 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 @endsection
