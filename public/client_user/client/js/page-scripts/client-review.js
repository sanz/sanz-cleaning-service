/*
filename: client-review.js
author: digyata
*/
//------------------------------------------------------------------------------------------------
$(document).ready(function () {

/*   $.each( $('.rating'), function( key, value ) {
    $(this).append(customRatingHTML(value.dataset.value));
  });
})

var customRatingHTML = function (value) {
  var ratingicons = document.createElement("span");
  ratingicons.setAttribute("class", "pl-1 font-medium-3");
  ratingicons.setAttribute("data-value", value);
  var rateicon = '<i class="fa fa-star text-warning"></i>';
  var ratehalficon = '<i class="fa fa-star-half-o text-warning"></i>';
  var unrateicon = '<i class="fa fa-star"></i>';
  if(value <= 5){
    var first = value % 1;
    var second = value - first;

    for (var i = 0; i < second; i++) {
      ratingicons.appendChild($.parseHTML(rateicon)[0]);
    }
    if (first !== 0) {
      ratingicons.appendChild($.parseHTML(ratehalficon)[0]);
      for (i = 0; i < (5 - value) - 1; i++){
        ratingicons.appendChild($.parseHTML(unrateicon)[0]);
      }
    } else {
      for (i = 0; i < (5 - value); i++){
        ratingicons.appendChild($.parseHTML(unrateicon)[0]);
      }
    }
  }
  return ratingicons; */
  
})