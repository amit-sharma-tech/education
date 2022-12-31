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
        'aff-dir-password' :{
          required:true
        },
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
  $('#select-state-stu-student').change(function () {
    let selectOption = $(this).val();
    if(selectOption  >= 1){
      // alert(selectOption);jQuery
      $("#select-city").val();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'post',
        url:"getCityNameListStudent",
        data:{ssId:selectOption},
        success:function(data){
          let result = JSON.parse(data);
          if(result.info == 1){
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
  // select course name according to course type

  $('#student-course-type').change(function () {
    let selectOption = $(this).val();
    if(selectOption  >= 1){
      $("#select-course").val();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'post',
        url:"getCourseListName",
        data:{ssId:selectOption},
        success:function(data){
          let result = JSON.parse(data);
          console.log(result,'4567890987654')
          if(result.info == 1){
            result.resp.forEach(ele => {
              $("#select-course").append("<option value='"+ele.id+"'>"+ele.course_name+"</option>");
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


  $('.affiliate-confirm-text').on('click', function () {
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
            url:"deleteAffiliateFromList",
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

  $('.affiliate-activeInactive').on('click', function () {
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
            url:"inactiveAffiliateFromList",
            data:{ccId:rowId,type:typeName},
            success:function(data){
              let result = JSON.parse(data);
              if(result.info == 1){
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

  //block transaction

  $('.affiliate-blockTransaction').on('click', function () {
    // alert('tyuioijhg')
    let rowId = $(this).data('id');
    let centerId = $(this).data('name');
    let typeName = $(this).data('type');
    Swal.fire({
      title: 'Are you sure?',
      text: `Are you sure want to block transction of this ${centerId}!`,
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
            url:"blockTransactionId",
            data:{ccId:rowId,type:typeName},
            success:function(data){
              let result = JSON.parse(data);
              if(result.info == 1){
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



