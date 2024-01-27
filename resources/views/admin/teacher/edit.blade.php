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
                            <h1>Edit Teacher Detail</h1>
                        </div>
                        <div class="col-sm-6" style="text-align:right">
                            <a href="{{ url('/admin/teacher/list') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>First Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('name',$getrecords->name) }}"
                                            placeholder="First Name" name="name">
                                        <div style="color:red">{{ $errors->first('name') }}</div>
                                    </div>


                                    <div class="form-group col-md-6"> <label>Last Name<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('last_name',$getrecords->last_name) }}"
                                            placeholder="Last Name" name="last_name">
                                        <div style="color:red">{{ $errors->first('last_name') }}</div>
                                    </div>
                                      <div class="form-group col-md-6">
                                        <label for=""> Gender <span style="color: red;">*</span></label>
                                        <select class="form-control" name="gender" required id="">
                                            <option value="">
                                                Select Gender</option>
                                                Female</option>
                                            <option {{ (old('gender',$getrecords->gender,$getrecords->gender) == 'Male')? 'selected' :'' }}>
                                                Male
                                            </option>
                                            <option {{ (old('gender',$getrecords->gender) == 'Other')? 'selected' : '' }}>
                                                Other</option>

                                        </select>
                                        <div style="color:red">{{ $errors->first('gender') }}

                                        </div>
                                    </div>  

                                    <div class="form-group col-md-6"> <label>DOB<span
                                                style="color: red;">*</span></label>
                                        <input type="date" class="form-control" value="{{ old('date_of_Birth',$getrecords->date_of_Birth) }}"
                                            required placeholder="DOB" name="date_of_birth">
                                        <div style="color:red">{{ $errors->first('date_of_Birth') }}

                                        </div>
                                    </div>
                                  <div class="form-group col-md-6"> <label>Date Of Joining<span
                                                style="color: red;">*</span></label>
                                        <input type="date" class="form-control" value="{{ old('admission_date',$getrecords->admission_date) }}"
                                            required placeholder="" name="admission_date">
                                        <div style="color:red">{{ $errors->first('admission_date') }}

                                        </div>
                                    </div>
                                     <div class="form-group col-md-6"> <label>Mobile Number<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('mobile_number',$getrecords->mobile_number) }}"
                                            placeholder="Mobile Number" name="mobile_number">
                                        <div style="color:red">{{ $errors->first('mobile_number') }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6"> <label>Matital Status<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('marital_status',$getrecords->marital_status) }}"
                                            placeholder="Matital Status" name="marital_status">
                                        <div style="color:red">{{ $errors->first('marital_status') }}

                                        </div>
                                    </div>
                                     
                                    <div class="form-group col-md-6"> <label>Profile Picture<span
                                                style="color: red;">*</span></label>

                                        <input type="file" class="form-control"
                                            value="{{ old('profile_picture',$getrecords->profile_picture) }}" required
                                            placeholder="Profile" name="profile_picture">
                                        <div style="color:red">{{ $errors->first('profile_picture') }}

                                        </div>
                                        @if(!empty($getrecords->getProfile()))
                                        <img src="{{$getrecords->getProfile()}}"
                                            style=" border-radius:50%; width: 50px; height:50px;">
                                        @endif

                                    </div>
                                    <div class="form-group col-md-6"> <label>Current Address<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('address',$getrecords->address) }}"
                                            placeholder="Current Address" name="address">
                                        <div style="color:red">{{ $errors->first('address') }}

                                        </div>
                                    </div>
                                      <div class="form-group col-md-6"> <label>Permanent Address<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('permanent_address',$getrecords->permanent_address) }}"
                                            placeholder="Permanent Address" name="permanent_address">
                                        <div style="color:red">{{ $errors->first('permanent_address') }}

                                        </div>
                                    </div>

                                   
                                    <div class="form-group col-md-6"> <label>Work Experience<span
                                                style="color: red;">*</span></label>
                                       <textarea class="form-control" name="work_experience" value="{{ old('work_experience',$getrecords->work_experience) }}"></textarea>
                                        <div style="color:red">{{ $errors->first('work_experience') }}</div>
                                    </div>  
                                    <div class="form-group col-md-6"> <label>Note<span
                                                style="color: red;">*</span></label>
                                       <textarea class="form-control" name="note" value="{{ old('note',$getrecords->note) }}"></textarea>
                                        <div style="color:red">{{ $errors->first('note') }}</div>
                                    </div>  
                                    <div class="form-group col-md-6"> <label>Qualification<span
                                                style="color: red;">*</span></label>
                                       <textarea class="form-control" name="qualification" value="{{ old('qualification',$getrecords->qualification) }}"></textarea>
                                        <div style="color:red">{{ $errors->first('qualification') }}</div>
                                    </div>

                                    <div class="form-group col-md-6"> <label>Status<span
                                                style="color: red;">*</span></label>
                                        <select class="form-control" required name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (old('status') == 0)? 'selected' :'' }} <option value="0">Active
                                            </option>
                                            <option {{ (old('status') == 1)? 'selected' :'' }} <option value="1">
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <label>Email<span style="color: red;">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email',$getrecords->email) }}"
                                    id="exampleInputEmail1" required placeholder="Enter Email">
                                <div style="color:red">{{ $errors->first('email') }}
                                </div>
                            </div>
                            <div class="card-body">
                                <label>Password<span style="color: red;">*</span></label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                    required placeholder="Password">
                                <div style="color:red">{{ $errors->first('password') }}
                                </div>
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