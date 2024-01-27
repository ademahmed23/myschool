
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
              <h1>Add Class</h1>
            </div>
            <div class="col-sm-6" style="text-align:right">
               <a href="{{url('/admin/class/list')}}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <form method="POST" action="{{Route('add_insert')}}">
            @csrf
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Class Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="validationCustom01" placeholder="Class Name" >
              <div style="color:red">{{$errors->first('name')}}</div>
              </div>
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Status</label>
                <select class="form-control" name="status" id="validationCustom01" placeholder="select status" >
                    {{-- <option value=""></option>     --}}
                    <option value="0">Active</option>
                    <option value="1">Inacive</option>
                </select>
              <div style="color:red">{{$errors->first('name')}}</div>
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
