
@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','University Student Registation Form')

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
          <h4 class="card-title">University Student Registation Form</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3">
                            <label>Student Name</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="student-name" class="form-control" name="full_name" placeholder="Student full Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                              <label>Mobile</label>
                            </div>
                            <div class="col-md-8 form-group">
                            <input type="text" id="contact-info" class="form-control" name="mobile" placeholder="Mobile">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="email" id="email-id" class="form-control" name="email-id" placeholder="Email">
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
                                    <input type="radio" name="bsradio" id="radio1" checked="">
                                    <label for="radio1">Male</label>
                                  </div>
                                  <div class="radio">
                                    <input type="radio" name="bsradio" id="radio2" checked="">
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
                              <input type="text" class="form-control datapickdob" placeholder="Select Date">
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
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                          <label>Father / Husband Name</label>
                          </div>
                          <div class="col-md-8 form-group">
                          <input type="text" id="fatehr_name" class="form-control" name="father_name" placeholder="Father / Husband Name">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Parent Mobile</label>
                          </div>
                          <div class="col-md-8 form-group">
                          <input type="text" id="contact-info" class="form-control" name="p_mobile" placeholder="Parent Mobile">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Address</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <textarea class="form-control" id="Address" name="Address" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>State</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select class="form-control select2 @error('select-state') is-invalid
                                @enderror" id="select-state-stu-student" name="select-state">
                                <option value="0" name="select_state">Select State</option>
                                @foreach($State as $post)
                                    <option value="{{$post->state_id}}" name="{{$post->state_title}}" id="id_{{$post->state_id}}">{{$post->state_title}}</option>
                                @endforeach
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
                          <input type="text" id="contact-info" class="form-control" name="pincode" placeholder="Pincode">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>School / University Name</label>
                          </div>
                          <div class="col-md-8 form-group">
                          <input type="text" id="contact-info" class="form-control" name="school_name" placeholder="School / University Name">
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                            <label>Batch Start Date</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <fieldset class="form-group position-relative has-icon-left">
                              <input type="text" class="form-control pickadate" placeholder="batch State Date">
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
                          <input type="text" id="contact-qualification" class="form-control" name="qualification" placeholder="Qualification">
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                            <label>Select Course Type</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select class="form-control select2 @error('select-state') is-invalid
                                @enderror" id="un-course-type" name="select-state">
                                <option value="0" name="select_state">Select Course Type</option>
                                @foreach($State as $post)
                                    <option value="{{$post->state_id}}" name="{{$post->state_title}}" id="id_{{$post->state_id}}">{{$post->state_title}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                            <label>Select Course</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select class="form-control select2 @error('select-state') is-invalid
                                @enderror" id="select-state" name="select-state">
                                <option value="0" name="select_state">Select Course</option>
                                @foreach($State as $post)
                                    <option value="{{$post->state_id}}" name="{{$post->state_title}}" id="id_{{$post->state_id}}">{{$post->state_title}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
        
                        <div class="row">
                          <div class="col-md-3">
                          </div>
                          <div class="col-md-8 form-group">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input error" id="validationCheck" name="validationCheck" aria-describedby="validationCheck-error">
                              <label class="custom-control-label" for="validationCheck">Agree to our terms and conditions</label>
                            </div><span id="validationCheck-error" class="error">This field is required.</span>
                          </div>
                        </div>
        
        
                        <div class="form-group">
                          
                        </div>
                        <div class="form-group">
                          
                        </div>
        
                        <div class="row">
                            <div class="col-sm-11 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-8 form-group">
                            <div class="imagepics" style="margin-bottom: 20px">
                                <img src="http://localhost:8000/images/portrait/small/avatar-s-16.jpg" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                            </div>
                            <div class="custom-file"><br>
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
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
