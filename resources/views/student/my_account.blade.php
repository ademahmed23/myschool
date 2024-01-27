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
                            <h1>My Account</h1>
                        </div>
                        <div class="col-sm-6" style="text-align:right">
                            <a href="{{ url('/admin/student/list') }}" class="btn btn-primary">Back</a>
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
                                        <input type="text" class="form-control"
                                            value="{{ old('name', $getrecords->name) }}" placeholder="First Name"
                                            name="name">
                                        <div style="color:red">{{ $errors->first('name') }}</div>
                                    </div>


                                    <div class="form-group col-md-6"> <label>Last Name<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('last_name', $getrecords->last_name) }}"
                                            placeholder="Last Name" name="last_name">
                                        <div style="color:red">{{ $errors->first('last_name') }}</div>
                                    </div>

                                   

                                    <div class="form-group col-md-6">
                                        <label for=""> Gender <span style="color: red;">*</span></label>
                                        <select class="form-control" name="gender" required id="">
                                            <option value="">
                                                Select Gender</option>
                                            <option
                                                {{ (old('gender', $getrecords->gender) == 'Female')? 'selected':'' }}
                                                value="Female">
                                                Female</option>
                                            <option
                                                {{ (old('gender', $getrecords->gender) == 'Male')? 'selected' :'' }}>
                                                Male
                                            </option>
                                            <option
                                                {{ (old('gender', $getrecords->gender) == 'Other')? 'selected' : '' }}>
                                                Other</option>

                                        </select>
                                        <div style="color:red">{{ $errors->first('gender') }}

                                        </div>
                                    </div>

                                    <!--<div class="form-group col-md-6">
                                        <label>Class Name</label>
                                        <select class="form-control" name="class_id" required>
                                            <option value="">Select Class</option>

                                        </select>
                                    </div>-->

                                    <div class="form-group col-md-6"> <label>DOB<span
                                                style="color: red;">*</span></label>
                                        <input type="date" class="form-control"
                                            value="{{ old('date_of_birth', $getrecords->date_of_birth) }}" required
                                            placeholder="DOB" name="date_of_birth">
                                        <div style="color:red">{{ $errors->first('date_of_Birth') }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6"> <label>Nationality<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('nation', $getrecords->nation) }}" placeholder="Nationality"
                                            name="nation">
                                        <div style="color:red">{{ $errors->first('nation') }}

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

                                    <div class="form-group col-md-6"> <label>Religion<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('religion', $getrecords->religion) }}"
                                            placeholder="Religion eg. Muslim" name="religion">
                                        <div style="color:red">{{ $errors->first('religion') }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6"> <label>Phone Number<span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('mobile_number', $getrecords->mobile_number) }}" required
                                            placeholder="Phone Number" name="mobile_number">
                                        <div style="color:red">{{ $errors->first('mobile_number') }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6"> <label>Blood
                                            Group<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" required
                                            placeholder="Blood Group eg. A-"
                                            value=" {{ old('blood_group',$getrecords->blood_group) }}"
                                            name="blood_group">
                                        <div style="color:red">
                                            {{ $errors->first('blood_group') }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Height</label><span style="color: red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('height',$getrecords->height) }}" placeholder="Height"
                                            name="height">
                                        <div style="color:red">{{ $errors->first('height') }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Weight</label><span style="color: red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('weight', $getrecords->weight) }}" placeholder="Weight"
                                            name="weight">
                                        <div style="color:red">{{ $errors->first('weight') }}


                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="card-body">
                                <label>Email<span style="color: red;">*</span></label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $getrecords->email) }}" id="exampleInputEmail1" required
                                    placeholder="Enter Email">
                                <div style="color:red">{{ $errors->first('email') }}
                                </div>
                            </div>
                            
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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