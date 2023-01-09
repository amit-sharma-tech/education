
@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Student Registation Form')

@section('vendor-styles')
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/daterange/daterangepicker.css')}}">

@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
            @if (@$studentEdit)
              <h4 class="card-title">Edit Student Registration Form</h4>  
            @else
              <h4 class="card-title">Student Registration Form</h4>
            @endif
        </div>
        @if (session('success'))
          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
          </div>
        @elseif(session('error'))
          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
          </div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
        <div class="card-body">
          @if (@$studentEdit)
            <form class="form form-horizontal"id="affliate-myprofile-validate" action="{{url('admin/student/submitstEditRegistration')}}" method="POST" enctype=multipart/form-data>
          @else
            <form class="form form-horizontal"id="affliate-myprofile-validate" action="{{url('admin/student/submitstRegistration')}}" method="POST" enctype=multipart/form-data>
          @endif
              @csrf
              <input type="hidden" name="hiddenId" value="@isset($studentEdit){{trim($studentEdit['id'])}}@endisset">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3">
                            <label>Student Name</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="student-name" class="form-control" name="full_name" placeholder="Student full Name" value="@isset($studentEdit){{trim($studentEdit['first_name'])}}@endisset" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                              <label>Mobile</label>
                            </div>
                            <div class="col-md-8 form-group">
                            <input name="mobile"  id="mobile" class="form-control" type="text" onkeyup="checkMobileValidate(); return false;" placeholder="Enter Mobile" value="@isset($studentEdit){{trim($studentEdit['s_mobile'])}}@endisset" autocomplete="off"><span id="message"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="email" id="email-id" class="form-control" name="email-id" placeholder="Email" required value="@isset($studentEdit){{trim($studentEdit['email'])}}@endisset" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                              <label>Gender</label>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <div class="custom-control-inline">
                                  <div class="radio mr-1">
                                    <input type="radio" value = "M" @if (@$studentEdit['gender']== "M" ) checked="" @else checked="" @endif  name="bsradio" id="radio1">
                                    <label for="radio1">Male</label>
                                  </div>
                                  <div class="radio">
                                    <input type="radio"  value = "F"  @if (@$studentEdit['gender']== "F" ) checked @endif  name="bsradio" id="radio2">
                                    <label for="radio2">Female</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>DOB</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <fieldset class="form-group position-relative has-icon-left">
                              <input type="text" class="form-control datapickdob" name= "datapickdob" placeholder="Select Date" required value="@isset($studentEdit){{trim($studentEdit['dob'])}}@endisset" autocomplete="off">
                              <div class="form-control-position">
                                <i class='bx bx-calendar'></i>
                              </div>
                            </fieldset>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                            <label>Password</label>
                            </div>
                            <div class="col-md-8 form-group">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required value="@isset($studentEdit){{trim($studentEdit['password'])}}@endisset" @isset($studentEdit)readonly  @endisset  autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                          <label>Father / Husband Name</label>
                          </div>
                          <div class="col-md-8 form-group">
                          <input type="text" id="fatehr_name" class="form-control" name="father_name" placeholder="Father / Husband Name" required value="@isset($studentEdit){{trim($studentEdit['father_name'])}}@endisset" autocomplete="off">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Parent Mobile</label>
                          </div>
                          <div class="col-md-8 form-group">
                          {{-- <input type="text" id="contact-info" class="form-control" name="p_mobile" placeholder="Parent Mobile" required> --}}
                          <input name="p_mobile"  id="mobile2" class="form-control" type="text" onkeyup="checkMobileValidate2(); return false;" placeholder="Enter Parent mobile" value="@isset($studentEdit){{trim($studentEdit['f_mobile'])}}@endisset" autocomplete="off"><span id="message2"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Address</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <textarea class="form-control" id="Address" name="Address" rows="3" required placeholder="Address" autocomplete="off">@isset($studentEdit){{trim($studentEdit['address'])}}@endisset</textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>State</label>
                          </div>
                          {{-- {{dd($State)}} --}}
                          <div class="col-md-8 form-group">
                            <select class="form-control select2 @error('select-state') is-invalid
                                @enderror" id="select-state-stu-student" name="select-state">
                                <option value="0" name="select_state">Select State</option>
                                @if (isset($studentEdit))
                                  @foreach ($State as $list)
                                    <option value="{{ $list->state_id }}" {{ ($studentEdit['state'] == $list->state_id ? "selected":"") }}>{{ $list->state_title }}</option>

                                  @endforeach
                                @else
                                  @foreach ($State as $list)
                                    <option value="{{$list->state_id}}" name="{{$list->state_title}}" id="id_{{$list->state_id}}">{{$list->state_title}}</option>
                                  @endforeach
                                @endif

                                {{-- @foreach($State as $post)
                                    <option value="{{$post->state_id}}" name="{{$post->state_title}}" id="id_{{$post->state_id}}">{{$post->state_title}}</option>
                                @endforeach --}}
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>City</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select class="form-control select2 @error('select-city') is-invalid
                                @enderror" id="select-city" name="select-city">
                                <option value="">Select City</option>
                                @if (isset($studentEdit))
                                  @foreach ($citiesList as $list)
                                    <option value="{{ $list->id }}" {{ ($studentEdit['city'] == $list->id ? "selected":"") }}>{{ $list->name }}</option>
                                  @endforeach
                                @endif
                            </select>
                            @error('select-city')
                              <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="select-city" data-validator="notEmpty">{{$message}}
                                </div>
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Pincode</label>
                          </div>
                          <div class="col-md-8 form-group">
                          <input type="text" id="contact-info" class="form-control" name="pincode" placeholder="Pincode" required minlength="6" maxlength="6" onkeypress="return isNumber(event)" value="@isset($studentEdit){{trim($studentEdit['pincode'])}}@endisset" autocomplete="off">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>School / University Name</label>
                          </div>
                          <div class="col-md-8 form-group">
                          <input type="text" id="contact-info" class="form-control" name="school_name" placeholder="School / University Name" required value="@isset($studentEdit){{trim($studentEdit['collage_name'])}}@endisset" autocomplete="off">
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                            <label>Batch Start Date</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <fieldset class="form-group position-relative has-icon-left">
                              <input type="text" class="form-control pickadate" name="batch_start" placeholder="batch State Date" required value="@isset($studentEdit){{trim($studentEdit['batch_start'])}}@endisset" autocomplete="off">
                              <div class="form-control-position">
                                <i class='bx bx-calendar'></i>
                              </div>
                            </fieldset>
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                            <label>Qualification</label>
                          </div>
                          
                          <div class="col-md-8 form-group">
                            <select class="form-control @error('select_quali') is-invalid
                                @enderror" id="select_quali" name="qualification" required>
                                <option value="0">Select Qualification</option>
                                <option @isset($studentEdit) @if ($studentEdit['qualification']== "POST-GRADUATION" ) selected @endif @endisset value="POST-GRADUATION">Post Graduation</option>
                                <option @isset($studentEdit) @if ($studentEdit['qualification']== "UNDER-GRADUATION" ) selected @endif @endisset value="UNDER-GRADUATION">Under Graduation</option>
                                <option @isset($studentEdit) @if ($studentEdit['qualification']== "OTHER" ) selected @endif @endisset value="OTHER">Other</option>
                            </select>
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                            <label>Select Course Type</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select class="form-control @error('select-course-type') is-invalid
                                @enderror" id="student-course-type" name="select-course-type" required>
                                <option value="0" name="select-course-type">Select Course Type</option>
                                @if (isset($studentEdit))
                                  @foreach ($coursetype as $list)
                                    <option value="{{ $list->id }}" {{ ($studentEdit['course_type'] == $list->id ? "selected":"") }}>{{ $list->course_name }}</option>

                                  @endforeach
                                @else
                                  @foreach ($coursetype as $list)
                                        <option value = "{{$list->id}}">{{$list->course_name}}</option>
                                  @endforeach
                                @endif 
                            </select>
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                            <label>Select Course</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select class="form-control select2 @error('select-course') is-invalid
                                @enderror" id="select-course" name="select-course" required>
                                <option value="0" name="select-course">Select Course</option>
                                @if (isset($studentEdit))
                                  @foreach ($coursesList as $list)
                                    <option value="{{ $list->id }}" {{ ($studentEdit['course_name'] == $list->id ? "selected":"") }}>{{ $list->course_name }}</option>
                                  @endforeach
                                @endif
                            </select>
                            @error('select-course')
                              <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="select-course" data-validator="notEmpty">{{$message}}
                                </div>
                              </div>
                            @enderror
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                          </div>
                          <div class="col-md-8 form-group">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input error" id="validationCheck" name="validationCheck" aria-describedby="validationCheck-error" checked>
                              <label class="custom-control-label" for="validationCheck">Agree to our terms and conditions</label>
                            </div>
                            {{-- <span id="validationCheck-error" class="error">This field is required.</span> --}}
                          </div>
                        </div>
        
        
                        <div class="form-group">
                          
                        </div>
                        <div class="form-group">
                          
                        </div>
        
                        <div class="row">
                            <div class="col-sm-11 d-flex justify-content-end">
                            <button type="submit" id="submitbt" class="btn btn-primary mr-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-8 form-group">
                            <div class="imagepics" style="margin-bottom: 20px">
                              {{-- <?php echo asset("storage/public/avatar-img.png");?> --}}
                                <img src="{{ storage_path('app/public/avatar-img.png') }}" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                            </div>
                            <div class="custom-file"><br>
                            <input type="file" name="image_name" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Student Picture</label>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Horizontal form layout section end -->

@endsection



{{-- vendor scripts --}}
@section('vendor-scripts')

<script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 5000;
    @if (Session::has('error'))
      toastr.error('{{ Session::get('error') }}');
    @elseif(Session::has('success'))
      toastr.success('{{ Session::get('success') }}');
    @endif
  });
  function isNumber(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

     return true;
  }
  function checkMobileValidate()
  {
    var mobile = document.getElementById('mobile');
    var message = document.getElementById('message');

    var validate = /^[6-9]{1}?[0-9]{9}$/;
    var badColor = "red";
    
    if(mobile.value.length!=10){
        // mobile.style.backgroundColor = badColor;
        message.style.color = badColor;
        document.getElementById('submitbt').disabled = true;
        message.innerHTML = "Mobile number should be 10 digit!"
    }else if(!validate.test(mobile.value)){
      message.style.color = badColor;
      document.getElementById('submitbt').disabled = true;
      message.innerHTML = "Mobile number is not valid!"
    }
    else{
      document.getElementById('message').innerHTML = "";
      document.getElementById('submitbt').disabled = false;
    }
  }

  function checkMobileValidate2()
  {
    var mobile = document.getElementById('mobile2');
    var message = document.getElementById('message2');

    var validate = /^[6-9]{1}?[0-9]{9}$/;
    var badColor = "red";
    if(mobile.value.length!=10){
        message.style.color = badColor;
        document.getElementById('submitbt').disabled = true;
        message.innerHTML = "Mobile number should be 10 digit!"
    }else if(!validate.test(mobile.value)){
      message.style.color = badColor;
      document.getElementById('submitbt').disabled = true;
      message.innerHTML = "Mobile number is not valid!"
    }
    else{
      document.getElementById('message2').innerHTML = "";
      document.getElementById('submitbt').disabled = false;
    }
  }

  </script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>

<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

<script src="{{asset('js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>

<script src="{{asset  ('js/scripts/forms/validation/admin-form-validation.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
@endsection
