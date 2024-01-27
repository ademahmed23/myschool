 
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
              <h1> Change Password</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


    <div class="row">
      <div class="col-md-12">
        @include('message')
        <div class="card card-primary"> 
          <form method="POST" action="">
            @csrf 
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Old Password</label>
                <input type="password" class="form-control" name="old_password" value="" id="validationCustom01" placeholder="Old  Password" >
              <div style="color:red">{{$errors->first('old_password')}}</div>  
              </div>
              <div class="card-body">
                <label>New Password</label>
                <input type="password" class="form-control" name="new_password" id="exampleInputPassword1" placeholder="New Password">
              <div style="color:red">{{$errors->first('new_password')}}</div>  
              </div>
            </div>
            <div class="card-footer">
              <button type="submit"  class="btn btn-primary">Submit</button>
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