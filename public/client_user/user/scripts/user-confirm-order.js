/*
 File Name: user-custom-order.js
 */
//-------------------------------------------------------------------------------------------

$(document).ready(function () {

      //DIV hide-show
      $(document).on('click', '#BO_btn2', function () {

            if (validation()) {
                  $('.s_state').text($('#cnfod_state').val());
                  $('.s_city').text($('#cnfod_city').val());
                  $('.s_address1').text($('#cnfod_ad1').val());
                  $('.s_address2').text($('#cnfod_ad2').val());
                  $('.s_pin').text($('#cnfod_pin').val());
                  $('#switch_inner2').slideUp();
                  $('#switch_inner3').removeAttr('hidden').fadeIn();;
            }
      });

      $(document).on('click', '#BO_btn3', function () {
            if (validation()) {
                  $('#cnfm-od-form').submit();
                  window.location.replace('/customers/orders/confirmed');
            }
      });
})

function validation(params) {
      var form = $('#cnfm-od-form');
      form.validate({
            rules: {
                  city: "required",
                  state: "required",
                  address1: "required",
                  address2: "required",
                  pincode: {
                        required: true,
                        number: true,
                        minlength: 6,
                        maxlength: 6
                  }
            }
      });
      return form.valid();
}
