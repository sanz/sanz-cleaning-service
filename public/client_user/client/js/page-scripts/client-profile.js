/**
 * File Name  :- client-profile.js
 * Author 		:- Sanz
 */

 $(document).ready(function () {

	HoldOn.open(options);
	$('#profile').css('background-image', 'url('+ $("#profile_img").val() +')').addClass('hasImage');
	HoldOn.close();
	// Verify Password
	$("#btn_confirm").on('click', function (e) {
		e.preventDefault();
		checkPassword();
	});

	function checkPassword() {
		var password = $("#oldPassword").val().trim();
		var error = $("#oldPassword-error");
		if(password != "" && password != null && password != undefined) {
			var url = "/client-password";
			var data = { "password" : password };
			HoldOn.open(options);
			$.get(url, data, function (result) {
				if(result) {
					$("#btn_confirm").hide();
					$("#sbt_btn").attr("hidden", false);
					$(".new_password").attr("hidden", false);
					$(".old_password").hide();
				} else {
					error.text("Enter Valid Password !!");
				}
			});
			HoldOn.close();
		} else {
			error.text("Enter Old Password !!");
		}
	}

	// Close Modal
	var setTime;
	$('#changePasswdModel').on('hidden.bs.modal', function (e) {
		$(this).find('form').trigger('reset').validate().resetForm();
		setTime= setTimeout(function (e) {
			$("#btn_confirm").show();
			$("#sbt_btn").attr("hidden", true);
			$(".new_password").attr("hidden", true);
			$(".old_password").show();
		}, 7000);
	});

	$("#changePasswdModel").on("shown.bs.modal", function (e) {
		clearTimeout(setTime);
	});

	// Password show-hide button
	$(".toggle-password").on('click' ,function(e) {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});

	// Update Password
	$("#sbt_btn").on('click', function (e) {
		$("#changePasswordForm").validate({
			rules : {
				new_password : {
					required: true,
					minlength: 6
				},
				con_password : {
					required : true,
					equalTo: "#newPassword"
				}
			},
			messages : {
				new_password : {
					required : "Enter New Password.",
					minlength: "Your password must be at least 6 characters long."
				},
				con_password : {
					required : "Enter Confirm Password.",
					equalTo: "Password did not match. Please try again...",
				}
			},
			submitHandler:  function(form) {
				
				Swal.fire({
					icon: 'info',
					text: 'Do you want to change the password ??',
					showDenyButton: true,
					showCancelButton: false,
					confirmButtonText: `Save`,
					denyButtonText: `Don't save`,
				}).then((result) => {
					if (result.isConfirmed) {
						form.submit();
					} else {
						Swal.fire('Changes are not saved.', '', 'success');
					}
				});
			}
		});
	});

	// Client detail form validation
	$('#client_sbt_btn').click(function () {
		$('#updateClientDetail').validate({
			rules: {
				// client_fname: 'required',
				// client_lname: 'required',
				client_name : "required",
				gender: "required",
				client_mo: {
					required: true,
					maxlength: 10,
					minlength: 10,
				},
				client_email: {
					required: true,
					email: true
				}
			},
			messages: {
				// client_fname: "Please enter your First Name",
				// client_lname: "Please enter your Last Name",
				client_name : "Enter your Full Name.",
				gender: "Please select your Gender",
				client_mo: {
					required: "Please enter the mobile no.",
				},
				client_email: {
					required: "Please enter your Email Address",
					email: "Please enter a valid email address"
				}
			},
			submitHandler:  function(form) {
				
				Swal.fire({
					icon: 'info',
					text: 'Do you want to save the changes ??',
					showDenyButton: true,
					showCancelButton: false,
					confirmButtonText: `Save`,
					denyButtonText: `Don't save`,
				}).then((result) => {
					if (result.isConfirmed) {
						HoldOn.open(options);
						uploadImg ("clientImgForm" , "/client-save-img")
						.then((path) => {
							if(path != ""){
								$("#profile_img").attr("value", path);
							}
							HoldOn.close();
							form.submit();
						})
						.catch((error) => {
							HoldOn.close();
							swalError();
						});
					} else {
						Swal.fire('Changes are not saved.', '', 'success');
					}
				});
			}
    	})
  	});

	// Number Validation
	numberValidation(".numberValidation");
	
});

function uploadImg(form_id, url) {
	let myform = document.getElementById(form_id);
    let formData = new FormData(myform);
    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                resolve(data)
            },
            error: function (error) {
                reject(error)
            },
        })
    })
}

function swalConfirm(title = "Do you want to save the changes?") {
	Swal.fire({
		title: 'Do you want to save the changes?',
		showDenyButton: true,
		showCancelButton: true,
		confirmButtonText: `Save`,
		denyButtonText: `Don't save`,
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire('Saved!', '', 'success')
		} else if (result.isDenied) {
			Swal.fire('Changes are not saved', '', 'info')
		}
	});
}

function swalError(msg = "Something went wrong!", title = "Oops...") {
    Swal.fire({
        icon: 'error',
        title: title,
        text: msg,
    }).then((result) => {
        location.reload();
    });
}

function numberValidation(input_id) {
    $(input_id).keypress(function (event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
}