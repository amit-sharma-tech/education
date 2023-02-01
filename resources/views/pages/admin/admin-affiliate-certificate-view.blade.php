@extends('layouts.contentLayoutMaster')
{{-- @include('config.fonts') --}}

{{-- page title --}}
@section('title','Certificate')
{{-- styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tinos"> --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">


@endsection
<style>
  .image-div {
      background-image: url('{{asset('images/pages/default-theme.jpeg')}}');
      /* position:absolute; */
      /* width:100%; */
      /* background-size:cover; */
      
  }

</style>
@section('content')
<!-- app invoice View Page -->
<section class="invoice-view-wrapper" >
  <div class="row">
    <!-- invoice view page -->
    <div class="col-xl-9 col-md-8 col-12 image-div" id="content">
      <div class="card1 invoice-print-area1">
        <div class="pb-0 mx-25">
          <div class="row">
            <div class="col-sm-2 col-12 my-2 my-sm-3"></div>
            <div class="col-sm-10 invoice-info">
              <div class="col-sm-6 col-10 mt-2" style="float: left;padding-left:0px!important">
                <span class="" style="float: left;width: 30%;">
                  <img src="{{asset('images/pages/samanwi-edu.jpeg')}}" alt="logo" height="100%" width="100%">
                </span>
                <span class="" style="float: left;padding-top:89px">
                  <span class="bold" style="font-size:25px;color:#2E3E58;font-weight:500">SAMANWI</span><br>
                  <span style="font-size: 25px;color: #2E3E58;font-weight:500">EDUCATION</span><br><span style="font-size: 12px;color:#F2E6BE">DISCOVER YOUR BEST</span>
                </span>
              </div>
              <div class="col-sm-5 col-8" style="float: right;padding-top: 96px;font-weight:400;text-align: right;color:#121332;font-size: 17px;">
                An IT, Vocatioal and Skill Development Institute
                    Registerd Under Company Act,2013<br>
                By Ministry of Corporation Affairs, Gov. of India<br>
                    (An ISO 9001:2015 Certified Institution)
              </div>
            </div>
          </div>
          <div class="row my-2">
            <div class="col-sm-3 col-12 my-2 my-sm-3"></div>
            <div class="col-sm-9 certficateAuth">
              <div class="font-effect-emboss" style="font-family: 'Sofia', sans-serif;
              font-size: 65px;
              text-shadow: 4px 4px 4px #aaa; color:#0A0C32">Certification of Authorization</div>
            </div>
          </div>
          <div class="row my-1" style="margin-bottom: -4rem !important;">
            <div class="col-sm-3 col-12  my-sm-3"></div>
            <div class="col-sm-9 cerityfthat">
              <div style="text-align: center;font-size:18px;font-weight:400;color:#0A0C32">This is to certify that :
              </div>
            </div>
          </div>
          <div class="row my-1">
            <div class="col-sm-3 col-12  my-sm-3"></div>
            <div class="col-sm-9 insName">
              <div style="font-family: 'Tinos', serif;
              font-size: 41px;
              text-shadow: 4px 4px 4px #aaa; color:#2C245F;font-weight:900;text-align: center;">{{strtoupper($resp['inst_name'])}}</div>
            <p style="text-align: center;
            margin-top: 13px;
            color: #0A0A0C;
            font-size: 18px;">{{$resp['full_address']}}</p>
            </div>
          </div>

          <div class="row my-2" style="margin-bottom: 0rem !important;">
            <div class="col-sm-3 col-12  my-sm-3"></div>
            <div class="col-sm-9 cerityfthat">
              <div style="text-align: center;font-size:18px;font-weight:400;color:#0A0C32">has been independently assessed by Samanwi Education Private Limited <br>for the Computer, IT, Voccational and Skill Developmentcourese.</div>
            </div>
          </div>

          <div class="row" style="margin-bottom: 3rem !important;">
            <div class="col-sm-2 col-12  my-sm-3"></div>
            <div class="col-sm-10 cerityfthat" style="padding-left: 60px !important;">
              <img src="{{asset('images/pages/logo-certificate.jpeg')}}" alt="logo" height="100%" width="60%" style="position:absolute;backgound-size:cover">
            </div>
          </div>

          <div class="row my-1">
            <div class="col-sm-2 col-12 "></div>
            <div class="col-sm-10 col-12 ">
              <div class="col-sm-8 insName" style="float:left">
                <div style="font-family: 'Tinos', serif;
                font-size: 30px;
                text-shadow: 4px 4px 4px #aaa; color:#2C245F;font-weight:900">SAMANWI EDUCATION PRIVATE LIMITED</div>
                <p style="text-align: left;
                margin-top: 13px;
                color: #2C245F;font-weight:400;
                font-size: 28px;">Bidesi Tola, Thawe(Gopalgnaj),Bihar, India</p>
              </div>
              <div class="col-sm-4 insName" style="float: right">
                <div id="signature" style="width: 100%;
                border-bottom: 1px solid black;
                height: 30px;">
                </div>
                <div id="signaturename" style="text-align: center;
                color: #2C245F;font-weight:600;
                font-size: 150%;">
                  ANUP SHRIVASTVA
                </div>
                <div id="signaturename" style="text-align: center;
                color:black;font-weight:400;
                font-size: 100%;">
                  AUTHORIZED SIGNATORY
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <!-- invoice action  -->
    <div class="col-xl-3 col-md-4 col-12">
      <div class="card invoice-action-wrapper shadow-none border">
        <div class="card-body">
          {{-- <div class="invoice-action-btn">
            <button class="btn btn-primary btn-block invoice-send-btn">
              <i class="bx bx-send"></i>
              <span>Send Invoice</span>
            </button>
          </div> --}}
          <div class="invoice-action-btn">
            <div id="editor"></div>
            <button class="btn btn-light-primary btn-block affliate_certificate_print">
              <span>print</span>
            </button>
          </div>
          {{-- <div class="invoice-action-btn">
            <a href="{{asset('app/invoice/edit')}}" class="btn btn-light-primary btn-block">
              <span>Edit Invoice</span>
            </a>
          </div>
          <div class="invoice-action-btn">
            <button class="btn btn-success btn-block">
              <i class='bx bx-dollar'></i>
              <span>Add Payment</span>
            </button>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
@endsection
