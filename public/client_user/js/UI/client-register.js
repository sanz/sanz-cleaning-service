/*=========================================================================================
    File Name: client-register.js
    Author: Sanz
==========================================================================================*/

$(document).ready( function () {

  //password hide/show btn
  $(".toggle-password").on('click' ,function(e) {
		e.preventDefault();
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});


    //Client Register validation
    $('#submit-register').click(function () {
      $('#Client-register').validate({
        rules: {
          name: "required",
          email: {
            required: true,
            email: true
          },
          mobile: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
          },
          gender: "required",
          password: {
            required: true,
            minlength: 6
          },
          password_confirmation: {
            required: true,
            equalTo: '#password_register'
          },
          captcha: "required",
        },
  
        messages: {
          name: "Please enter your full name",
          email: {
            required: "Please enter your email address",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
          },
          mobile: {
            required: "Please enter your mobile no.",
            minlength: "Mobile No. must have 10 digit",
            maxlength: "Mobile No. must have 10 digit",
            number: "Please enter only digits",
          },
          gender: "Please select your gender",
          password_confirmation: {
            required: "Please enter a confirm password",
            equalTo: "Password and confirm password must be same"
          },
          captcha: "Please enter captcha."
        },
        submitHandler: function(form) {
          form.submit();
        }
      });
    })
  
  
  })
  