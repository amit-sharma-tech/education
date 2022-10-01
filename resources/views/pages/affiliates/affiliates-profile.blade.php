@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','User Profile')
{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-user-profile.css')}}">
@endsection

@section('content')
<!-- page user profile start -->
<section class="page-user-profile">
  <div class="row">
    <div class="col-12">
      <!-- user profile heading section start -->
      
      <!-- user profile heading section ends -->

      <!-- user profile content section start -->
      <div class="row">
        <!-- user profile nav tabs content start -->
        <div class="col-lg-12">
          <div class="tab-content">
            <div class="tab-pane active" id="profile" aria-labelledby="profile-tab" role="tabpanel">
              <!-- user profile nav tabs profile start -->
              <div class="card">
                <h5 class="card-header border-bottom mb-1">Registed Record</h5>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-12 col-sm-3 text-center mb-1 mb-sm-0">
                          <p>
                          @if ($profile != null)
                            <img src="{{ asset('storage/affiliates/'.$profile->profile_name) }}" alt="" title="" class="rounded"
                            alt="group image" height="120" width="120">
                          @endif
                          </p>
                          <p class="mt-5">
                            @if ($profile->center_name != null)
                              <img src="{{ asset('storage/affiliates/'.$profile->center_name) }}" alt="" title="" class="rounded"
                              alt="group image" height="120" width="120">
                            @endif
                            </p>
                        </div>
                        
                        <div class="col-12 col-sm-9">
                          <div class="row">
                            <table class="table table-striped">
                              <tbody>
                                <tr>
                                  <td>Center Id</td>
                                  <td>{{$profile->center_id}}</td>
                                </tr>
                                <tr>
                                  <td>Samanwiedu Id</td>
                                  <td>{{$profile->samanwiedu_id}}</td>
                                </tr>
                                <tr>
                                  <td>Center/Institute name</td>
                                  <td>{{$profile->inst_name}}</td>
                                </tr>
                                <tr>
                                  <td>Director name</td>
                                  <td>{{$profile->dir_name}}</td>
                                </tr>
                                <tr>
                                  <td>Contact No</td>
                                  <td>{{$profile->contact_no}}</td>
                                </tr>
                                <tr>
                                  <td>Email</td>
                                  <td>{{$profile->email}}</td>
                                </tr>
                                <tr>
                                  <td>Address</td>
                                  <td>{{$profile->address}}</td>
                                </tr>
                                <tr>
                                  <td>Locality</td>
                                  <td>{{$profile->locality}}</td>
                                </tr>
                                  @if ($stateName)
                                    <tr>
                                      <td>State</td>
                                      <td>{{$stateName->state_title}}</td>
                                    </tr>
                                  @endif
                                    @if ($cityName)
                                    <tr>
                                      <td>City</td>
                                      <td>{{$cityName->name}}</td>
                                    </tr>
                                    @endif
                                <tr>
                                  <td>Register Date</td>
                                  <td>
                                    @if ($profile->register_dt != null)
                                      {{date('d M y', strtotime($profile->register_dt))}}
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>Course</td>
                                  <td>{{$profile->course_list}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <a href="{{ url('affiliate/editprofile') }}">
                            <button class="btn btn-sm d-none d-sm-block float-right btn-light-primary mb-2">
                              <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>Edit</span>
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- user profile nav tabs profile ends -->
            </div>
          </div>
        </div>
        <!-- user profile nav tabs content ends -->
      </div>
      <!-- user profile content section start -->
    </div>
  </div>
</section>
<!-- page user profile ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-user-profile.js')}}"></script>
@endsection
