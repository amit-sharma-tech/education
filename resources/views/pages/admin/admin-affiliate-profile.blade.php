@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users View')
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
<!-- users view start -->
<section class="users-view">
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
      <div class="media mb-2">
        <a class="mr-1" href="javascript:void(0);">
          {{-- <img src="{{asset('images/portrait/small/avatar-s-26.jpg')}}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64"> --}}
            <img src="{{url($user['profile_path'])}}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="100" width="100">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{$user['inst_name']}} </span><span
              class="text-muted font-medium-1"> {{-- @</span><span
              class="users-view-username text-muted font-medium-1 ">{{$user['center_id']}}</span> --}}</h4>
          <span>CENTER ID:</span>
          <span class="users-view-id">{{$user['center_id']}}</span><br><br>
          <span>CONTACT NUMBER:</span>
          <span class="users-view-id">{{$user['contact_no']}}</span>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
      <a href="javascript:void(0);" class="btn btn-sm mr-25 border"><i class="bx bx-envelope font-small-3"></i></a>
      <a href="javascript:void(0);" class="btn btn-sm mr-25 border">Profile</a>
      <a href="{{asset('app/users/edit')}}" class="btn btn-sm btn-primary">Edit</a>
    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-4">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Registered:</td>
                <td>{{date('Y M d',strtotime($user['register_dt']))}}</td>
              </tr>
              <tr>
                <td>Latest Activity:</td>
                <td class="users-view-latest-activity">30/04/2019</td>
              </tr>
              <tr>
                <td>Mobile Verified:</td>
                @if($user['mobile_verified'] == 0)
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-danger">Pending</div></td>
                @else
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-success">Success</div></td> 
                @endif
              </tr>
              <tr>
                <td>Email verified:</td>
                @if($user['email_verified'] == 0)
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-danger">Pending</div></td>
                @else
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-success">Success</div></td> 
                @endif
              </tr>
              <tr>
                <td>Payment Status:</td>
                @if($user['block_transaction'] != 'ACTIVE')
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-danger">Blocked</div></td>
                @else
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-success">Active</div></td> 
                @endif
              </tr>
              <tr>
                <td>Affiliate Login Status:</td>
                @if($user['is_active'] != 'ACTIVE')
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-danger">Blocked</div></td>
                @else
                    <td class="users-view-verified"><div class="badge badge-pill badge-light-success">Active</div></td> 
                @endif
                {{-- <td><span class="badge badge-light-success users-view-status">Active</span></td> --}}
              </tr>

            </tbody>
          </table>
        </div>
        <div class="col-12 col-md-8">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>Module Permission</th>
                  <th>Read</th>
                  <th>Write</th>
                  <th>Create</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Users</td>
                  <td>Yes</td>
                  <td>No</td>
                  <td>No</td>
                  <td>Yes</td>
                </tr>
                <tr>
                  <td>Articles</td>
                  <td>No</td>
                  <td>Yes</td>
                  <td>No</td>
                  <td>Yes</td>
                </tr>
                <tr>
                  <td>Staff</td>
                  <td>Yes</td>
                  <td>Yes</td>
                  <td>No</td>
                  <td>No</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
  <!-- users view card details start -->
  <div class="card">
    <div class="card-body">
      <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
        <div class="col-12 col-sm-4 p-2">
          <h6 class="text-primary mb-0">Total balance: <span class="font-large-1 align-middle">&#8377;125</span></h6>
        </div>
        <div class="col-12 col-sm-4 p-2">
          <h6 class="text-primary mb-0">Students: <span class="font-large-1 align-middle">534</span></h6>
        </div>
        <div class="col-12 col-sm-4 p-2">
          <h6 class="text-primary mb-0">University: <span class="font-large-1 align-middle">256</span></h6>
        </div>
      </div>
      <div class="col-12">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Username:</td>
              <td class="users-view-username">{{$user['username']}}</td>
            </tr>
            <tr>
              <td>Diretor Name:</td>
              <td class="users-view-name">{{Ucfirst($user['dir_name'])}}</td>
            </tr>
            <tr>
              <td>E-mail:</td>
              <td class="users-view-email">{{$user['email']}}</td>
            </tr>
            <tr>
              <td>Institute Name:</td>
              <td>{{$user['inst_name']}}</td>
            </tr>

          </tbody>
        </table>
        {{-- <h5 class="mb-1"><i class="bx bx-link"></i> Social Links</h5>
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Twitter:</td>
              <td><a href="javascript:void(0);">https://www.twitter.com/</a></td>
            </tr>
            <tr>
              <td>Facebook:</td>
              <td><a href="javascript:void(0);">https://www.facebook.com/</a></td>
            </tr>
            <tr>
              <td>Instagram:</td>
              <td><a href="javascript:void(0);">https://www.instagram.com/</a></td>
            </tr>
          </tbody>
        </table> --}}
        <h5 class="mb-1"><i class="bx bx-info-circle"></i> Affilicate Details</h5>
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td>Address:</td>
              <td>{{ucfirst($user['address'])}}</td>
            </tr>
            <tr>
              <td>Town/Locality:</td>
              <td>{{ucfirst($user['locality'])}}</td>
            </tr>
            <tr>
                <td>State/City:</td>
                <td>English</td>
            </tr>
            <tr>
                <td>Pincode:</td>
                <td>{{$user['pincode']}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- users view card details ends -->

</section>
<!-- users view ends -->
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-users.js')}}"></script>
@endsection
