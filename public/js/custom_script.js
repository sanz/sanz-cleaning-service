
function swalFire(Swal, msg = 'Message!!!', title = "Success!!!", icon = "success"){
    Swal.fire({
        icon: icon,
        title: title,
        text: msg,
        showCancelButton: false
    });
}

function toastFire(Swal, title = "Title", icon = "success") {
    Swal.mixin({
        toast: true,
        position: 'bottom-left',
        showConfirmButton: true,
        showCancelLink: true,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    }).fire({
        icon: icon,
        title: title
    })
}

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
  
})