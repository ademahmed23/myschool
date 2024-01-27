 
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
              <h1>Assign Subject</h1>
            </div>
            <div class="col-sm-6" style="text-align:right">
               <a href="{{url('/admin/assign_subject/list')}}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary"> 
          <form method="POST" action="{{Route('assign_subject.insert')}}">
            @csrf 
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Class Name</label> 
                <select class="form-control" name="class_id" id="validationCustom01" placeholder="Select Type" > 
                  @foreach ($ClassGetrecords as $value)
                  <option value="{{$value->id}}">{{$value->name}}</option>
                  @endforeach
                </select>  
              <div style="color:red">{{$errors->first('type')}}</div>  
              </div>
              <div class="card-body"> 
                <label for="validationCustom01" class="form-label">Subject Name</label> 
                  @foreach ($SubjectGetrecords as $value)
                    <div class="" style="font-weight:normal;">
                      <input type="checkbox" value="{{$value->id}}" name="subject_id[]">  {{$value->name}}
                    </div>
                  @endforeach
              <div style="color:red">{{$errors->first('type')}}</div>  
              </div>
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Status</label> 
                <select class="form-control" name="status" id="validationCustom01" placeholder="select status" > 
                    {{-- <option value=""></option>     --}}
                    <option value="0">Active</option>
                    <option value="1">Inacive</option>   
                </select>  
              <div style="color:red">{{$errors->first('Status')}}</div>  
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