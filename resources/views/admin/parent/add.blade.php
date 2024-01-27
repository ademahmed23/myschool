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
                            <h1>Add New Parent</h1>
                        </div>
                        <div class="col-sm-6" style="text-align:right">
                            <a href="{{ url('/admin/parent/list') }}" class="btn btn-primary">Back</a>
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
                                        <input type="text" class="form-control" value="{{ old('name') }}"
                                            placeholder="First Name" name="name">
                                        <div style="color:red">{{ $errors->first('name') }}</div>
                                    </div>


                                    <div class="form-group col-md-6"> <label>Last Name<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('last_name') }}"
                                            placeholder="Last Name" name="last_name">
                                        <div style="color:red">{{ $errors->first('last_name') }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for=""> Gender <span style="color: red;">*</span></label>
                                        <select class="form-control" name="gender" required id="">
                                            <option value="">
                                                Select Gender</option>
                                            <option {{ (old('gender') == 'Female')? 'selected':'' }} value="Female">
                                                Female</option>
                                            <option {{ (old('gender') == 'Male')? 'selected' :'' }}>
                                                Male
                                            </option>
                                            <option {{ (old('gender') == 'Other')? 'selected' : '' }}>
                                                Other</option>

                                        </select>
                                        <div style="color:red">{{ $errors->first('gender') }}

                                        </div>
                                    </div>




                                    <div class="form-group col-md-6"> <label>Occupation<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('occupation') }}"
                                            placeholder="Occupation" name="Occupation">
                                        <div style="color:red">{{ $errors->first('occupation') }}

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6"> <label>Mobile Number<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('mobile_number') }}"
                                            placeholder="Mobile Number" name="mobile_number">
                                        <div style="color:red">{{ $errors->first('mobile_number') }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6"> <label>Profile Picture<span
                                                style="color: red;">*</span></label>

                                        <input type="file" class="form-control" value="{{ old('profile_picture') }}"
                                            placeholder="Profile" name="profile_picture">
                                    </div>
                                    <div class="form-group col-md-6"> <label>Address<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('address') }}"
                                            placeholder="Address" name="address">
                                        <div style="color:red">{{ $errors->first('address') }}

                                        </div>
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
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
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