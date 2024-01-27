 
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
              <h1>Update Subject</h1>
            </div>
            <div class="col-sm-6" style="text-align:right">
               <a href="{{url('admin/subject/list')}}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div>
      </section>


    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary"> 
          {{-- @php
              echo "<pre>";
                print_r();
              echo "</pre>";
          @endphp --}}
          <form method="POST" action="{{url('admin/subject/update/'.$getrecords->id)}}">
            @csrf
              <div class="card-body">
                <label for="validationCustom01" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $getrecords->name)}}" id="validationCustom01" placeholder="Enter Name" >
               <div style="color:red">{{$errors->first('name')}}</div>  
              </div>
              <div class="card-body">   
                <label>Type</label>
                <select class="form-control" name="type" value="{{old('type', ) }}"    id="exampleInputEmail1" placeholder="select status ">
                <option {{!empty($getrecords->type == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                <option {{!empty($getrecords->type == 'Practical') ? 'selected' : '' }} value="Practical">Practical</option>
                </select>
                <div style="color:red">{{$errors->first('email')}}</div>  
              </div>  
              <div class="card-body">   
                <label>Status</label>
                <select class="form-control" name="status" value="{{old('satus', ) }}"    id="exampleInputEmail1" placeholder="select status ">
                <option {{!empty($getrecords->status == 0) ? 'selected' : '' }} value="0">Active</option>
                <option {{!empty($getrecords->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                </select>
                <div style="color:red">{{$errors->first('status')}}</div>  
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