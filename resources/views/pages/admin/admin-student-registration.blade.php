@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Form Layout')

@section('content')
<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Horizontal Form</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-3">
                    <label>Student Name</label>
                    </div>
                    <div class="col-md-5 form-group">
                    <input type="text" id="student-name" class="form-control" name="full_name" placeholder="Student full Name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label>DOB</label>
                    </div>
                    <div class="col-md-5 form-group">
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
                    <label>Mobile</label>
                    </div>
                    <div class="col-md-5 form-group">
                    <input type="number" id="contact-info" class="form-control" name="contact" placeholder="Mobile">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                    <label>Password</label>
                    </div>
                    <div class="col-md-5 form-group">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                    <button type="reset" class="btn btn-light-secondary">Reset</button>
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
