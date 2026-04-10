/*=========================================================================================
    File Name: user-register.js
    Author: Sanz
==========================================================================================*/

$(document).ready(function () {

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


    //User-register Validation
    $(document).on('click', '#us_sub_btn', function () {
        $('#User-register').validate({
            rules: {
                name: "required",
                gender: "required",
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
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#User_password'
                },
                captcha: {
                    required: true,
                }
            },

            messages: {
                name: "Please enter your name.",
                gender: "Please select your gender.",
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address."
                },
                password: {
                    required: "Please enter a password.",
                    minlength: "Your password must be at least 6 characters long."
                },
                mobile: {
                    required: "Please enter your mobile no.",
                    minlength: "Mobile No. must have 10 digit.",
                    maxlength: "Mobile No. must have 10 digit.",
                    number: "Please enter only digits.",
                },
                password_confirmation: {
                    required: "Please enter a confirm password.",
                    equalTo: "Password and confirm password must be same."
                },
                captcha: {
                    required: "Please enter captcha."
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    })

})
