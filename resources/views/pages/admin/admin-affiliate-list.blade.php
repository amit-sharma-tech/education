@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users List')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
  <div class="users-list-table">
    <div class="card">
      @if (session('status'))
          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
          </div>
        @elseif(session('failed'))
          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
          </div>
        @endif
      <div class="card-body">
        <!-- datatable start -->
        <div class="table-responsive">
          <table id="users-list-datatable" class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>Username</th>
                <th>User&nbsp;Name</th>
                <th>Center&nbsp;Id</th>
                <th>Email/Mobile</th>
                <th>Address</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($affiliateList as $item)
              <tr id="row_{{$item['id']}}">
                <td>{{$item['count']}}</td>
                <td><a href="{{asset('app/users/view')}}">{{($item['username'])}}</a> </td>
                {{-- <td>{{($item['username'])}}</td> --}}
                <td>{{Str::ucfirst($item['first_name'])}}&nbsp;&nbsp;{{Str::ucfirst($item['last_name'])}}</td>
                <td>{{($item['center_id'])}}/{{$item['samanwiedu_id']}}</td>
                <td>{{($item['email'])}}/{{$item['contact_no']}}</td>
                <td>{{Str::ucfirst($item['address'])}}</td>
                <td>{{date('Y-m-d H:m:i',strtotime($item['register_dt']))}}</td>
                @if ($item['is_active'] == 'ACTIVE')
                    @php
                      $statusName = "Inactive";
                      $icon = 'bx bx-block mr-1';
                      $name = "INACTIVE";
                    @endphp
                  <td><span class="badge badge-light-success">Active</span></td>  
                @elseif ($item['is_active'] == 'INACTIVE')
                    @php
                      $statusName = "Active";
                      $icon = 'bx bx-lock-open mr-1';
                      $name = "ACTIVE";
                    @endphp
                  <td><span class="badge badge-light-danger">Inactive</span></td>
                @endif
                
                <td>
                  <div class="dropdown">
                    <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                      <a class="dropdown-item affiliate-confirm-text" data-id="{{$item['id']}}" href="javascript:void(0);"><i class="bx bx-trash mr-1"></i> delete</a>
                      <a class="dropdown-item affiliate-activeInactive" data-name="{{$name}}" data-id="{{$item['id']}}" href="javascript:void(0);" ><i class="{{$icon}}"></i>{{$statusName}}</a>
                      <a class="dropdown-item affiliate-changePassword" data-name="PWD" data-id="{{$item['id']}}" href="javascript:void(0);" ><i class="bx bx-notepad mr-1"></i>Change Password</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- datatable ends -->
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>


<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/polyfill.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {
  let tableName = $('#users-list-datatable').DataTable({
        order: [[0, 'desc']],
  })
});
</script>

@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset  ('js/scripts/forms/validation/admin-form-validation.js')}}"></script>
@endsection