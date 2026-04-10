/*
 File Name: client-listing.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {

      $('.pagination .page-item:first-child .page-link').text('Prev');
      $('.pagination .page-item:last-child .page-link').text('Next');

      //no of items
      var Ino = $("#search-content .search-item").length;
      $('.page_header span').text(Ino + ' Records');
    
      //search
      $(".search-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#search-content .search-item").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        var count =  $("#search-content .search-item").filter(':visible').length;
        $('.page_header span').text(count + ' Records');
      });

      //Dropdown Services 
      $("#SL_service").on("change", function () {
        window.location.replace($(this).val());
      });
    
    })
    