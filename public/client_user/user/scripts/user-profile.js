/*
 filename: user-profile.js
 author: sanz
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {

      $(document).on('focus', 'input[type=password]', function () {
            $(this).removeAttr('readonly');
      });

      //State options
      $("#us_state").append(
            '<option value="" disable>Select State</option>'
      );
      var url = "/data/provinces.json";
      $.getJSON(url, function (arr) {
            var tmp = $('#us_state').data('val');
            $.each(arr, function (key, entry) {
                  $("#us_state").append(
                        '<option class="state_opt" '+((tmp==entry)?"selected":"")+' value="' + entry + '">' + entry + "</option>"
                  );
            });
      });

      //on change gender bold class toggle
      $(document).on('change', 'input[name = gender]', function () {
            $(this).siblings('label').addClass('font-weight-bold');
            $('input[name = gender]').not(':checked').siblings('label').removeClass('font-weight-bold');
      });

      //On click Edit Password Hide/Show Div
      $(document).on('click', '#chngpswdbtn, #cncpswdbtn', function () {
            $('#chngepassworddiv').toggleClass('display-hidden');
      });

      
      //profile form Validation
      
    /*         $('#updt-prof-btn').click(function () {
            $('#profile-update-form').validate({

                  rules: {
                        name: 'required',
                        gender: "required",
                        mobile: {
                              required: true,
                              number: true,
                              minlength: 10,
                              maxlength: 10
                        },
                        email: {
                              required: true,
                              email: true
                        },
                        oldpassword: {
                              required: true,
                              minlength: 6
                        },
                        newpassword: {
                              required: true,
                              minlength: 6
                        },
                        confirmnewpassword: {
                              required: true,
                              equalTo: '#us_new_pswd'
                        }
                  },
                  messages: {
                        name: "Please enter your Name",
                        gender: "Please select your Gender",
                        mobile: {
                              required: "Please enter your mobile no.",
                              minlength: "Mobile No. must have 10 digit",
                              maxlength: "Mobile No. must have 10 digit",
                              number: "Please enter only digits",
                        },
                        email: {
                              required: "Please enter your Email Address",
                              email: "Please enter a valid email address"
                        },
                        oldpassword: {
                              required: "Please enter the old password.",
                              minlength: "Your password must be at least 6 characters long."
                        },
                        newpassword: {
                              required: "Please enter the new password.",
                              minlength: "Your password must be at least 6 characters long."
                        },
                        confirmnewpassword: {
                              required: "Please confirm new password.",
                              equalTo: "New password and confirm new password must be same."
                        }
                  },
                  submitHandler: function (form) {
                        form.submit();
                  }
            });
      })*/
 

})