<!DOCTYPE html>
<!--
Template Name: Bytepillar
Author: :Amit Sharma
Website: http://www.bytepillar.com/

-->
{{-- pageConfigs variable pass to Helper's updatePageConfig function to update page configuration  --}}
@isset($pageConfigs)
  {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
// confiData variable layoutClasses array in Helper.php file.
  $configData = Helper::applClasses();
@endphp

<html class="loading" lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif"
 data-textdirection="{{$configData['direction'] == 'rtl' ? 'rtl' : 'ltr' }}" data-asset-path="{{ asset('/')}}">
  <!-- BEGIN: Head-->

    <head>
    <meta  charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') Welcome to Samanwiedu</title>
    <link rel="apple-touch-icon" href="{{asset('images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/ico/favicon.ico')}}">

    {{-- Include core + vendor Styles --}}
    @include('panels.styles')
    </head>
    <!-- END: Head-->
    {{--  @if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType']))
     {{-- @include(($configData['mainLayoutType'] === 'horizontal-menu') ? 'layouts.horizontalLayoutMaster':'layouts.verticalLayoutMaster') --}} --}}
     @if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType']))
      @include('layouts.verticalLayoutMaster')
     @else
     {{-- if mainLaoutType is empty or not set then its print below line --}}
     <h1>{{'mainLayoutType Option is empty in config custom.php file.'}}</h1>
     @endif

</html>


