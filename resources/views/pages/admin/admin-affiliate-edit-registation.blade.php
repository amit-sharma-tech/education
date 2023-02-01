@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','My profile')

@section('vendor-styles')
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/daterange/daterangepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
@endsection

@section('content')
<!-- Simple Validation start -->
<section class="simple-validation">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Center Profile</h4>
        </div>
        <div class="card-body">
          @if (@$affiliateEdit)
            <form id="affliate-myprofile-validate" action="{{url('admin/affiliate/submitAffiliateProfile')}}" method="POST" enctype=multipart/form-data>
              @csrf
              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <div class="d-flex align-items-center">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                  </div>
                </div>
              @endif
              {{-- @method('PUT') --}}
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-inst-name">Center/Institute name</label>
                    <input
                      type="text"
                      class="form-control @error('aff-inst-name') is-invalid
                      @enderror"
                      id="aff-inst-name"
                      name="aff-inst-name"
                      placeholder="Center/Institute name"
                      autocomplete="off"
                      value="{{ $affiliateEdit['center_id'] }}"
                    />
                    @error('aff-inst-name')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-inst-name" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-dir-name">Director name</label>
                    <input
                      type="text"
                      class="form-control @error('aff-dir-name') is-invalid
                      @enderror"
                      id="aff-dir-name"
                      name="aff-dir-name"
                      placeholder="Director name"
                      autocomplete="off"
                      value="{{ $affiliateEdit['dir_name'] }}"
                    />
                    @error('aff-dir-name')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-dir-name" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-dir-password">Password</label>
                    <input
                      type="password"
                      class="form-control @error('aff-dir-password') is-invalid
                      @enderror"
                      id="aff-dir-password"
                      name="aff-dir-password"
                      placeholder="Password"
                      autocomplete="off"
                      value="{{$$affiliateEdit['password']}}"
                      readonly
                    />
                    @error('aff-dir-password')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-dir-password" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-contact-no">Contact No</label>
                    <input
                      type="text"
                      class="form-control @error('aff-contact-no') is-invalid
                      @enderror"
                      id="aff-contact-no"
                      name="aff-contact-no"
                      minlength="10" maxlength="10" onkeyup="checkMobileValidate(); return false;"
                      placeholder="Enter only contact number"
                      autocomplete="off"
                      value="{{ $affiliateEdit['contact_no'] }}"
                    />
                    @error('aff-contact-no')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-contact-no" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-email-id">Email</label>
                    <input
                      type="email"
                      id="aff-email-id"
                      name="aff-email-id"
                      autocomplete="off"
                      class="form-control @error('aff-email-id') is-invalid
                      @enderror"
                      value="{{ $affiliateEdit['email'] }}"
                    />
                    @error('aff-email-id')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-email-id" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-locality">Locality</label>
                    <input
                      type="text"
                      id="aff-locality"
                      name="aff-locality"
                      class="form-control"
                      autocomplete="off"
                      value="{{ $affiliateEdit['locality'] }}"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-address">Town/Village</label>
                    <input
                      type="text"
                      id="aff-address"
                      name="aff-address"
                      autocomplete="off"
                      class="form-control @error('aff-address') is-invalid 
                      @enderror"
                      value="{{ $affiliateEdit['address'] }}"
                    />
                    @error('aff-address')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-address" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="select-state">State</label>
                    <select class="form-control select2 @error('select-state') is-invalid
                    @enderror" id="select-state-affilicate" name="select-state">
                      <option value="0" name="select_state">Select State</option>
                      @foreach($State as $post)
                        <option value="{{$post->state_id}}" name="{{$post->state_title}}" id="id_{{$post->state_id}}">{{$post->state_title}}</option>
                      @endforeach
                    </select>
                    {{-- @error('select_state')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="select_state" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror --}}
                  </div>
                </div>
              </div>
              <div class="row cityList">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="select-city">City</label>
                    <select class="form-control select2 @error('select-city') is-invalid
                    @enderror" id="select-city-affilicate" name="select-city">
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
              </div> 
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-course-list">Pincode</label>
                    <input type="text" id="contact-info" class="form-control" name="pincode" placeholder="Pincode" required minlength="6" maxlength="6" onkeypress="return isNumber(event)" value="{{ $affiliateEdit['pincode'] }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-registered-no">Registration Date</label>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="text" class="form-control pickadate @error('register_date') is-invalid
                      @enderror" name="register_date" placeholder="Select Date" value="{{ $affiliateEdit['register_dt'] }}" autocomplete="off">
                      @error('register_date')
                        <div class="fv-plugins-message-container invalid-feedback">
                          <div data-field="register_date" data-validator="notEmpty">{{$message}}
                          </div>
                        </div>
                      @enderror
                      <div class="form-control-position">
                        <i class='bx bx-calendar'></i>
                      </div>
                    </fieldset>
                  </div>
                </div>
              </div>        
              {{-- <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-course-list">Course</label>
                    <input
                      type="text"
                      id="aff-course-list"
                      name="aff-course-list"
                      class="form-control"
                    />
                  </div>
                </div>
              </div> --}}
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Director pic</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('customFile') is-invalid
                      @enderror" id="customFile" name="customFile" />
                      @error('customFile')
                        <div class="fv-plugins-message-container invalid-feedback">
                          <div data-field="customFile" data-validator="notEmpty">{{$message}}
                          </div>
                        </div>
                      @enderror
                      <label class="custom-file-label" for="customFile">Choose Director pic</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Center pic</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="centerFile" name="centerFile" />
                      <label class="custom-file-label" for="centerFile">Center Logo</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-5"></div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                </div>
              </div>
            </form>
          @else
            <form id="affliate-myprofile-validate" action="{{url('admin/affiliate/submitAffiliateProfile')}}" method="POST" enctype=multipart/form-data>
              @csrf
              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <div class="d-flex align-items-center">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                  </div>
                </div>
              @endif
              {{-- @method('PUT') --}}
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-inst-name">Center/Institute name</label>
                    <input
                      type="text"
                      class="form-control @error('aff-inst-name') is-invalid
                      @enderror"
                      id="aff-inst-name"
                      name="aff-inst-name"
                      placeholder="Center/Institute name"
                      autocomplete="off"
                      value="{{ old('aff-inst-name') }}"
                    />
                    @error('aff-inst-name')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-inst-name" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-dir-name">Director name</label>
                    <input
                      type="text"
                      class="form-control @error('aff-dir-name') is-invalid
                      @enderror"
                      id="aff-dir-name"
                      name="aff-dir-name"
                      placeholder="Director name"
                      autocomplete="off"
                      value="{{ old('aff-dir-name') }}"
                    />
                    @error('aff-dir-name')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-dir-name" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-dir-password">Password</label>
                    <input
                      type="password"
                      class="form-control @error('aff-dir-password') is-invalid
                      @enderror"
                      id="aff-dir-password"
                      name="aff-dir-password"
                      placeholder="Password"
                      autocomplete="off"
                    />
                    @error('aff-dir-password')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-dir-password" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-contact-no">Contact No</label>
                    <input
                      type="text"
                      class="form-control @error('aff-contact-no') is-invalid
                      @enderror"
                      id="aff-contact-no"
                      name="aff-contact-no"
                      minlength="10" maxlength="10" onkeyup="checkMobileValidate(); return false;"
                      placeholder="Enter only contact number"
                      autocomplete="off"
                      value="{{ old('aff-contact-no') }}"
                    />
                    @error('aff-contact-no')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-contact-no" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-4"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-email-id">Email</label>
                    <input
                      type="email"
                      id="aff-email-id"
                      name="aff-email-id"
                      autocomplete="off"
                      class="form-control @error('aff-email-id') is-invalid
                      @enderror"
                      value="{{ old('aff-email-id') }}"
                    />
                    @error('aff-email-id')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-email-id" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-locality">Locality</label>
                    <input
                      type="text"
                      id="aff-locality"
                      name="aff-locality"
                      class="form-control"
                      autocomplete="off"
                      value="{{ old('aff-locality') }}"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-address">Town/Village</label>
                    <input
                      type="text"
                      id="aff-address"
                      name="aff-address"
                      autocomplete="off"
                      class="form-control @error('aff-address') is-invalid 
                      @enderror"
                      value="{{ old('aff-address') }}"
                    />
                    @error('aff-address')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="aff-address" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="select-state">State</label>
                    <select class="form-control select2 @error('select-state') is-invalid
                    @enderror" id="select-state-affilicate" name="select-state">
                      <option value="0" name="select_state">Select State</option>
                      @foreach($State as $post)
                        <option value="{{$post->state_id}}" name="{{$post->state_title}}" id="id_{{$post->state_id}}">{{$post->state_title}}</option>
                      @endforeach
                    </select>
                    {{-- @error('select_state')
                      <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="select_state" data-validator="notEmpty">{{$message}}
                        </div>
                      </div>
                    @enderror --}}
                  </div>
                </div>
              </div>
              <div class="row cityList">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="select-city">City</label>
                    <select class="form-control select2 @error('select-city') is-invalid
                    @enderror" id="select-city-affilicate" name="select-city">
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
              </div> 
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-course-list">Pincode</label>
                    <input type="text" id="contact-info" class="form-control" name="pincode" placeholder="Pincode" required minlength="6" maxlength="6" onkeypress="return isNumber(event)" value="{{ old('pincode') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-registered-no">Registration Date</label>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="text" class="form-control pickadate @error('register_date') is-invalid
                      @enderror" name="register_date" placeholder="Select Date" value="{{ old('register_date') }}" autocomplete="off">
                      @error('register_date')
                        <div class="fv-plugins-message-container invalid-feedback">
                          <div data-field="register_date" data-validator="notEmpty">{{$message}}
                          </div>
                        </div>
                      @enderror
                      <div class="form-control-position">
                        <i class='bx bx-calendar'></i>
                      </div>
                    </fieldset>
                  </div>
                </div>
              </div>        
              {{-- <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label" for="aff-course-list">Course</label>
                    <input
                      type="text"
                      id="aff-course-list"
                      name="aff-course-list"
                      class="form-control"
                    />
                  </div>
                </div>
              </div> --}}
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Director pic</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('customFile') is-invalid
                      @enderror" id="customFile" name="customFile" />
                      @error('customFile')
                        <div class="fv-plugins-message-container invalid-feedback">
                          <div data-field="customFile" data-validator="notEmpty">{{$message}}
                          </div>
                        </div>
                      @enderror
                      <label class="custom-file-label" for="customFile">Choose Director pic</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Center pic</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="centerFile" name="centerFile" />
                      <label class="custom-file-label" for="centerFile">Center Logo</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-5"></div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                </div>
              </div>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Input Validation end -->
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

<script src="{{asset('js/scripts/forms/validation/admin-form-validation.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
@endsection

