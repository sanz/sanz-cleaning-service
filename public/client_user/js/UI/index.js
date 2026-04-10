/*
 File Name: index.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {
      $(' input[list="services"]').change(function () {
            console.log($(this).attr('data-link'));
            $('#search-service').attr('action', $("#services").find('option[value="' + $(this).val() + '"]').data("link"));
      })
})
