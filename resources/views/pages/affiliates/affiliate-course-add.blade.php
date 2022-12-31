@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Form Validation')

@section('vendor-styles')
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
@endsection

@section('content')
<!-- Simple Validation start -->
<section class="simple-validation">
  <div class="row">
    <div class="col-md-12">
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
        {{-- {{dd($courseName[0])}} --}}
        <div class="card-header">
          @empty($courseName)
            <h4 class="card-title">Course Add</h4>
          @else
            <h4 class="card-title">Course Edit</h4>
          @endempty
        </div>
        <div class="card-body">
          <form id="jquery-val-form" action="{{url('affiliate/course/submitAddCourse')}}" method="POST">
            @csrf
            <input type="hidden" name="hiddenId" value="@isset($courseName){{trim($courseName[0]->id)}}@endisset">
            <div class="form-group">
              <label class="form-label" for="basic-default-name">Course Name</label>
              <input
                type="text"
                class="form-control"
                id="course_name"
                name="course_name"
                placeholder="Course Name"
                autocomplete="off"
                required
                value="@isset($courseName){{trim($courseName[0]->course_name)}}@endisset"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-default-title">Course Title</label>
              <input
                type="text"
                id="course_title"
                name="course_title"
                class="form-control"
                placeholder="Course title"
                autocomplete="off"
                required
                value="@isset($courseName){{trim($courseName[0]->course_title)}}@endisset"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-default-duration">Course Duration</label>
              <input
                type="text"
                id="course_duration"
                name="course_duration"
                class="form-control"
                placeholder="Course Duation"
                autocomplete="off"
                required
                value="@isset($courseName){{trim($courseName[0]->course_duration)}}@endisset"
              />
            </div>
            {{-- <div class="form-group">
              <label class="form-label" for="confirm-type">Course Type</label>
              <fieldset class="form-group">
                <select class="form-control" id="basicSelect" name="course_type">
                  <option>Select Course Name</option>
                  @foreach ($courseType as $list)
                    <option value = {{$list->id}}>{{$list->course_name}}</option>
                  @endforeach
                </select>
              </fieldset>
            </div> --}}
            <div class="form-group">
                <label class="form-label" for="confirm-type">Course Type</label>
                <fieldset class="form-group">
                  <select class="form-control" id="basicSelect" name="course_type">
                    <option>Select Course Name</option>
              @if (isset($courseName))
                    @foreach ($courseType as $list)
                          {{-- <option value = "{{$list->id}}">{{$list->course_name}}</option> --}}
                      <option value="{{ $list->id }}" {{ ($courseName[0]->course_type == $list->id ? "selected":"") }}>{{ $list->course_name }}</option>
  
                    @endforeach
              @else
                    @foreach ($courseType as $list)
                          <option value = "{{$list->id}}">{{$list->course_name}}</option>
                    @endforeach
              @endif  
                  </select>
                </fieldset>              
              </div>
            <div class="form-group">
                <label class="form-label" for="confirm-subject">NO. Of Subject </label>
                <input
                  type="text"
                  id="course_subject"
                  name="course_subject"
                  class="form-control"
                  placeholder="Subject"
                  autocomplete="off"
                  required
                  value="@isset($courseName){{$courseName[0]->subject}}@endisset"
                />
              </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Input Validation end -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset  ('js/scripts/forms/validation/admin-form-validation.js')}}"></script>
@endsection
