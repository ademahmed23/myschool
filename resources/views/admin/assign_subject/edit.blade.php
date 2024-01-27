 
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
          <form method="POST" action="{{url('admin/assign_subject/update/'.$getrecord->id)}}"> 
            @csrf 
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Class Name</label>
                <select class="form-control" name="class_id" id="validationCustom01" placeholder="Select Type" > 
                  <option value=""><b>Select Class</b></option>
                  @foreach ($getClass as $class)
                  <option {{($getrecord->class_id == $class->id) ? 'selected' : '' }} value="{{$class->id}}">{{$class->name}}</option>
                  @endforeach
                </select>  
              <div style="color:red">{{$errors->first('type')}}</div>   
              </div>
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Subject Name</label> 
                  @foreach ($getSubject as $subject)
                    @php
                        $checked="";
                    @endphp
                    @foreach ($getAssignSubjectID as $subjectassign)
                      @if ($subjectassign->subject_id == $subject->id)  
                        @php
                            $checked="checked";
                        @endphp
                      @endif
                    @endforeach
                    <div class="" style="font-weight:normal;">
                      <input {{$checked}}  type="checkbox" value="{{$subject->id}}" name="subject_id[]">  {{$subject->name}}
                    </div>
                  @endforeach
              <div style="color:red">{{$errors->first('type')}}</div>  
              </div>
               <div class="card-body">   
                <label>Status</label>
                <select class="form-control" name="status" value="{{old('status', ) }}"    id="exampleInputEmail1" placeholder="select status ">
                <option {{!empty($getrecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                <option {{!empty($getrecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                </select>
                <div style="color:red">{{$errors->first('status')}}</div>  
              </div>
              
            <div class="card-footer">
              <button type="submit"  class="btn btn-primary">Update</button>
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