/**
 *  File Name	 : client-order-manage.js
 *  Author		 : digyata
*/

$(document).ready(function () {

	//Close modal by click ESC key
	$(document).on('keyup' , function(e){
		if (e.keyCode === 27 ){
			$('#viewOrderModal').modal('hide');
		}
	});

	$(document).on('click', '.btnViewModal', function (e) {
		HoldOn.open(options);
		var id = $(this).attr("data-id");
		var modal = $("#viewOrderModal").find(".modal-content");

		var url = "/clients/orders/list";
		var data = {
			'action' : 'Detail',
			'id' : id
		};
        $.get(url, data, function (result) {	
			console.log(result);
			// Order Info
			modal.find(".provider_name").text(result["provider_name"]);
			modal.find(".order_id").text(result["order_id"]);
			modal.find(".service_name").text(result["service_name"]);
			modal.find(".service_cat").text(result["service_cat"]);
			modal.find(".booking_date").text(result["booking_date"]);
			modal.find(".booking_time").text(result["booking_time"]);
			modal.find(".city").text(result["city"]);
			modal.find(".address").text(result["address"]);
			if( result["service_status"] == "pending" ){
				modal.find(".service_status").html('<i class="pending">Pending</i>');
			} else if ( result["service_status"] == "approved" ) {
				modal.find(".service_status").html('<i class="approved">Completed</i>');
			} else if ( result["service_status"] == "cancel" ) {
				modal.find(".service_status").html('<i class="cancel">Cancelled</i>');
			}

			//User Info
			modal.find(".user_id").text(result["user_id"]);
			modal.find(".user_name").text(result["user_name"]);
			modal.find(".user_email").html('<a href="mailto:'+result["user_email"]+'">'+result["user_email"]+'</a>');
			modal.find(".user_phone").html('<a href="tel:'+result["user_phone"]+'">'+result["user_phone"]+'</a>');

			//Client Info
			modal.find(".client_id").text(result["client_id"]);
			modal.find(".client_name").text(result["client_name"]);
			modal.find(".client_email").html('<a href="mailto:'+result["client_email"]+'">'+result["client_email"]+'</a>');

			//Item
			if ( result["payment_status"] == 1 ) {
				modal.find(".payment_status").html('<i class="approved">Completed</i>');
			} else {
				modal.find(".payment_status").html('<i class="pending">Pending</i>');
			}

			modal.find(".item_list").empty();
			var total = 0;
			$.each( result['items'], function( key, value ) {
				total = total + parseInt(value['item_price'])
				var html = '<div class="row "><div class="col-md-10"><label>' + (key + 1) + '.  </label><label>' + value['item_name'] + '</label></div><div class="col-md-2 text-right font-weight-bold">$CA ' + parseInt(value['item_price']) + '/-</div></div>';
				modal.find(".item_list").append(html);
			});
			modal.find(".grand_total").html("$CA "+ total +"/-");
			$('#viewOrderModal').modal('show');

		})
			.fail(function () {
				swalError();
			})
			.always(function () {
				HoldOn.close();
			});

		
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