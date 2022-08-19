/*=========================================================================================
  File Name: form-validation.js
  Description: jquery bootsreap validation js
  ----------------------------------------------------------------------------------------
  Item Name: Bytepillar
  Version: 1.0
  Author: Amit Sharma
==========================================================================================*/


$(function () {
  'use strict';

  var jqForm = $('#jquery-val-form'),
    select = $('.select2');

  // select2
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this
      .select2({
        placeholder: 'Select value',
        dropdownParent: $this.parent()
      })
      .change(function () {
        $(this).valid();
      });
  });
  // jQuery Validation
  // --------------------------------------------------------------------
  if (jqForm.length) {
    jqForm.validate({
      rules: {
        'basic-default-name': {
          required: true
        },
        'basic-default-email': {
          required: true,
          email: true
        },
        'basic-default-password': {
          required: true
        },
        'confirm-password': {
          required: true,
          equalTo: '#basic-default-password'
        },
        'select-country': {
          required: true
        },
        customFile: {
          required: true
        },
        validationRadiojq: {
          required: true
        },
        validationBiojq: {
          required: true
        },
        validationCheck: {
          required: true
        }
      }
    });
  }

  // affiliate-login-validate code start from here
  var affiliate_login = $('#affiliate-login-validate');
  if (affiliate_login.length) {
    affiliate_login.validate({
      rules: {
        'password': {
          required: true
        },
        'email': {
          required: true,
          email: true
        },
      }
    });
  }
  // affiliate-login-validate code end from here


  //affiliate-register start from here

  // affiliate-login-validate code start from here
  var affiliate_login = $('#affiliate-registation-validate');
  if (affiliate_login.length) {
    affiliate_login.validate({
      rules: {
        'first_name': {
          required: true
        },
        'second_name': {
          required: true,
        },
        'email': {
          required: true,
          email:true
        },
        'username': {
          required: true,
        },
        'password': {
          required: true,
        },
      }
    });
  }
  //affiliate=-register end here


  //affliate-myprofile-validate
  var affliateMyprofileValidate = $('#affliate-myprofile-validate');
  if (affliateMyprofileValidate.length) {
    
    $.validator.addMethod( "samanwieduId", function( value, element ) {
      return this.optional( element ) || /^\w+$/i.test( value );
    }, "Letters, numbers, and underscores only please." );

    $.validator.addMethod( "centerName", function( value, element ) {
      return this.optional( element ) || /^[a-zA-Z ]*$/i.test( value );
    }, "Letters only allows." );

    $.validator.addMethod("mobileValidate",function(value,element){
      return this.optional(element ) || /^[6-9]{1}?[0-9]{9}$/i.test(value);
    },"Enter valid mobile number");

    affliateMyprofileValidate.validate({
      rules: {
        'aff-center-id': {
          required: true,
          number:true,
          minlength:5,
          maxlength:20
        },
        'aff-samanwiedu-id':"required samanwieduId",
        'aff-inst-name' : "required centerName",
        'aff-dir-name' : "required centerName",
        'aff-contact-no' : "required mobileValidate",
        "aff-email-id" : {
          required:true,
          email:true,
        },
        'aff-address' : {
          required:true,
        },
        'select-state' : {
          required:true
        },
        'select-city' :{
          required:true
        },
        customFile: {
          required: true
        },
      }
    });
  }
});



$(document).ready(function($){
  $('#select-state').change(function () {
    let selectOption = $(this).val();
    if(selectOption  >= 1){
      // alert(selectOption);jQuery
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'post',
        url:"getCityName",
        data:{ssId:selectOption},
        success:function(data){
          let result = JSON.parse(data);
          if(result.info == 1){
            // $('.cityList').css('display','block');
            // document.getElementsByClassName('cityList').style.visibility = "visible";
            let dropDown="";
            result.resp.forEach(ele => {
              $("#select-city").append("<option value='"+ele.id+"'>"+ele.name+"</option>");
            });
          }
          else{
            alert(result.message)
          }
        }
     })
    }
    else{
      alert('Please select state name')
    }
  })
})