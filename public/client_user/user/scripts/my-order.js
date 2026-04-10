/*
 filename: my-order.js
 author: digyata
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {


  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-left',
    showConfirmButton: true,
    showCancelButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  const confirmbox = Swal.mixin({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  });

  $(document).on('click', '.od_approve', function () {
    var th = $(this);
    var id = th.attr("data-id");
    confirmbox.fire({
      showLoaderOnConfirm: true,
      preConfirm: () => {
        HoldOn.open(options);
        return $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "/customers/orders/update",
          type: "POST",
          data: { id },
          success: function (data) {
            HoldOn.close();
            th.parentsUntil('.od_div').find('.od_status').text('complete').addClass('approved').removeClass('pending');
            th.remove();
            Toast.fire({
              icon: 'success',
              title: 'Order Completed Successfully.'
            });
          },
          error: function (xhr, error) {
            HoldOn.close();
            console.log(error);
            swalError();
          }
        });
      }
    });
  });

  function swalError(msg = "Something went wrong!", title = "Oops...") {
    Swal.fire({
      icon: 'error',
      title: title,
      text: msg,
    }).then((result) => {
      location.reload();
    });
  }

})


