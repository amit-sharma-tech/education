@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Register Page')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- register section starts -->
<section class="row flexbox-container">
  <div class="col-xl-8 col-10">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
          <!-- register section left -->
          <div class="col-md-6 col-12 px-0">
            <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
              <div class="card-header pb-1">
                  <div class="card-title">
                      <h4 class="text-center mb-2">Sign Up</h4>
                  </div>
              </div>
              <div class="text-center">
                <p> <small> Please enter your details to sign up and be part of our great community</small>
                </p>
              </div>
              <div class="card-body">
                @if(Session::has('success'))
                  <div class="alert alert-success">
                      {{ Session::get('success') }}
                      @php
                          Session::forget('success');
                      @endphp
                  </div>
                @endif
                <form action="{{url('auth/signup-verfication')}}" id="affiliate-registation-validate" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-50">
                            <label for="first_name">first name</label>
                            <input type="text" class="form-control @error('first_name')is-invalid @enderror" id="first_name" value="{{ old('first_name')}}"
                                placeholder="First name" name="first_name">
                        </div>
                        <div class="form-group col-md-6 mb-50">
                            <label for="last_name">last name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid
                            @enderror" id="last_name" name="last_name" value="{{old('last_name')}}"
                                placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group mb-50">
                        <label class="text-bold-600" for="username">username</label>
                        <input type="text" class="form-control @error('username')is-invalid
                        @enderror" id="username" name="username" value="{{old('username')}}"
                            placeholder="Username">
                        @error('username')
                          <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="username" data-validator="notEmpty">{{$message}}
                            </div>
                          </div>
                        @enderror
                    </div>
                    <div class="form-group mb-50">
                        <label class="text-bold-600" for="email">Email address</label>
                        <input type="email" class="form-control @error('email')is-invalid
                        @enderror" id="email" name="email" value="{{old('email')}}"
                            placeholder="Email address">
                          @error('email')
                            <div class="fv-plugins-message-container invalid-feedback">
                              <div data-field="formValidationEmail" data-validator="notEmpty">{{$message}}
                              </div>
                            </div>
                          @enderror
                    </div>
                            
                    <div class="form-group mb-2">
                        <label class="text-bold-600" for="password">Password</label>
                        <input type="password" class="form-control @error('password')is-invalid
                        @enderror" id="password" name="password" 
                            placeholder="Password">
                        @error('password')
                          <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="password" data-validator="notEmpty">{{$message}}
                            </div>
                          </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary glow position-relative w-100">SIGN UP<i
                            id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                </form>
                <hr>
                <div class="text-center">
                  <small class="mr-25">Already have an account?</small>
                  <a href="{{url('auth/affiliates-login')}}"><small>Sign in</small> </a>
                </div>
              </div>
            </div>
          </div>
          <!-- image section right -->
          <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
            <img class="img-fluid" src="{{asset('images/pages/register.png')}}" alt="branding logo">
          </div>
      </div>
    </div>
  </div>
</section>
<!-- register section endss -->
@endsection
