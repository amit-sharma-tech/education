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
                <th>Course&nbsp;Name</th>
                <th>User&nbsp;Name</th>
                <th>Course&nbsp;Title</th>
                <th>Course&nbsp;Duration</th>
                <th>Course&nbsp;Type</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($courseList as $item)
              <tr id="row_{{$item->id}}">
                <td>{{$item->id}}</td>
                {{-- <td><a href="{{asset('app/users/view')}}">dean3004</a> </td> --}}
                <td>{{Str::ucfirst($item->course_name)}}</td>
                <td>{{Str::ucfirst($item->first_name)}}&nbsp;&nbsp;{{Str::ucfirst($item->last_name)}}</td>
                <td>{{Str::ucfirst($item->course_title)}}</td>
                <td>{{$item->course_duration}}</td>
                <td>{{Str::ucfirst($item->course_type)}}</td>
                <td>{{date('Y-m-d',strtotime($item->created_at))}}</td>
                @if ($item->is_active == 'ACTIVE')
                    @php
                      $statusName = "Inactive";
                      $icon = 'bx bx-lock mr-1';
                      $name = "INACTIVE";
                    @endphp
                  <td><span class="badge badge-light-success">Active</span></td>  
                @elseif ($item->is_active == 'INACTIVE')
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
                      <a class="dropdown-item" href="{{url('admin/course/admineditcourse/'.$item->id)}}"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                      <a class="dropdown-item confirm-text" data-id="{{$item->id}}" href="javascript:void(0);"><i class="bx bx-trash mr-1"></i> delete</a>
                      <a class="dropdown-item activeInactive" data-name="{{$name}}" data-id="{{$item->id}}" href="javascript:void(0);" ><i class="{{$icon}}"></i>{{$statusName}}</a>
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
  $('.confirm-text').on('click', function () {
    // alert('tyuioijhg')
    let rowId = $(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure want to delete this records!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-danger ml-1',
      buttonsStyling: false,
      preConfirm: function (login) {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:'post',
            url:"deleteCourseFromList",
            data:{ccId:rowId},
            success:function(data){
              let result = JSON.parse(data);
              if(result.info == 1){
                $('#row_'+rowId).fadeOut('1000');
                Swal.fire(
                  {
                    icon: "success",
                    title: 'Deleted!',
                    text: result.message,
                    confirmButtonClass: 'btn btn-success',
                  }
                )
              }
              else{
                Swal.fire(
                  {
                    icon: "errorz",
                    title: 'Error!',
                    text: result.message,
                    confirmButtonClass: 'btn btn-success',
                  }
                )
              }
            }
          })
      },
      allowOutsideClick: function () {
        !Swal.isLoading()
      }
    })
  });

  $('.activeInactive').on('click', function () {
    // alert('tyuioijhg')
    let rowId = $(this).data('id');
    let typeName = $(this).data('name');
    Swal.fire({
      title: 'Are you sure?',
      text: `Are you sure want to ${typeName} this records!`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-danger ml-1',
      buttonsStyling: false,
      preConfirm: function (login) {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:'post',
            url:"inactiveCourseFromList",
            data:{ccId:rowId,type:typeName},
            success:function(data){
              let result = JSON.parse(data);
              if(result.info == 1){
                // $('#row_'+rowId).fadeOut('1000');
                /* let table = $('#users-list-datatable').DataTable();
                table.ajax.reload(); */
                setTimeout(() => {
                  window.location.reload();
                }, 3000);
                Swal.fire(
                  {
                    icon: "success",
                    title: `${typeName}`,
                    text: result.message,
                    confirmButtonClass: 'btn btn-success',
                  }
                )
              }
              else{
                Swal.fire(
                  {
                    icon: "errorz",
                    title: 'Error!',
                    text: result.message,
                    confirmButtonClass: 'btn btn-success',
                  }
                )
              }
            }
          })
      },
      allowOutsideClick: function () {
        !Swal.isLoading()
      }
    })
  });

});
</script>

@endsection

{{-- page scripts --}}
@section('page-scripts')
{{-- <script src="{{asset('js/scripts/pages/app-users.js')}}"></script> --}}
@endsection
