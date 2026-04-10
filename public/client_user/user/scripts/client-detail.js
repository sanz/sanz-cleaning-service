/*
 File Name: client-details.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {

      $(document).on('click', '#plc_oder_btn', function () {
            $('#placeorderform').validate({
                  errorPlacement: function errorPlacement(error) { $('.error_message').append(error) },
                  rules: {
                        date: "required",
                        time: "reqiured",
                        'services[]': "required",
                        selected_time: "required"
                  },
                  messages: {
                        date: "Please select Date.",
                        time: "Please select Time.",
                        'services[]': "Please select Service.",
                        selected_time: "Please select Time.",

                  },
                  submitHandler: function (form) {
                        form.submit();
                  }

            });
      });

});
