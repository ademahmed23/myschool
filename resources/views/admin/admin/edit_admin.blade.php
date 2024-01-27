 
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
              <h1>Edit Admin</h1>
            </div>
            <div class="col-sm-6" style="text-align:right">
               <a href="{{url('admin/admin/list')}}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div>
      </section>


    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary"> 
          {{-- @php
              echo "<pre>";
                print_r($records->id);
              echo "</pre>";
          @endphp --}}
          <form method="POST" action="{{url('admin/admin/update/'.$records->id)}}">
            @csrf
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $records->name)}}" id="validationCustom01" placeholder="Enter Name" >
               <div style="color:red">{{$errors->first('name')}}</div>  
              </div>
              <div class="card-body">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email', $records->email) }}"    id="exampleInputEmail1" placeholder="Enter Email">
                <div style="color:red">{{$errors->first('email')}}</div>  
              </div>  
              <div class="card-body">
                <label>Password</label>
                <input type="text" class="form-control" name="password"  id="exampleInputPassword1" placeholder="Password">
                <p>Do you want to change Password ? So please add new password.</p>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit"  class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </section>
</div>
@endsection