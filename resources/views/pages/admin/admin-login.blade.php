@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Login Page')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
@endsection

@section('content')
<!-- login page start -->
<section id="auth-login" class="row flexbox-container">
  <div class="col-xl-8 col-11">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-login -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">Welcome Back Admin</h4>
              </div>
            </div>
            <div class="card-body">
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
              <form action="{{url('auth/login-verfication')}}" method="POST" id="affiliate-login-validate">
                @csrf
                  <div class="form-group mb-50">
                      <label class="text-bold-600" for="email">Email address</label>
                      <input type="input" class="form-control @error('email')is-invalid @enderror" name="email" id="email"
                          placeholder="Email address" value="{{ old('email')}}">
                      @error('email')
                        <div class="fv-plugins-message-container invalid-feedback">
                          <div data-field="formValidationEmail" data-validator="notEmpty">{{$message}}
                          </div>
                        </div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label class="text-bold-600" for="password">Password</label>
                      <input type="password" class="form-control @error('password')is-invalid @enderror" name="password" id="password" placeholder="Password">
                      @error('password')
                        <div class="fv-plugins-message-container invalid-feedback">
                          <div data-field="formValidationEmail" data-validator="notEmpty">{{$message}}
                          </div>
                        </div>
                      @enderror
                  </div>
                  <input type="hidden" value="1" name="typeValue">
                  <div
                      class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                      <div class="text-left">
                          <div class="checkbox checkbox-sm">
                            {{-- <a href="{{asset('auth/affiliate_register')}}"
                              class="card-link"><small>Affiliate Registation</small></a> --}}
                              {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                          </div>
                      </div>
                      <div class="text-right"><a href="{{asset('auth/forgot/password')}}"
                              class="card-link"><small>Forgot Password</small></a></div>
                  </div>
                  <button type="submit" class="btn btn-primary glow w-100 position-relative">Login<i
                          id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
              </form>
            </div>
          </div>
        </div>
        <!-- right section image -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
          <img class="img-fluid" src="{{asset('images/pages/login.png')}}" alt="branding logo">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- login page ends -->

@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
{{-- <script src="{{asset  ('js/scripts/forms/validation/form-validation.js')}}"></script> --}}
{{-- <script src="{{asset  ('js/scripts/forms/validation/common_validation_code.js')}}"></script> --}}
@endsection
