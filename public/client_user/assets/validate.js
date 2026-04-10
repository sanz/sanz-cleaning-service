/* <![CDATA[ */

/// Jquery validate newsletter
$('#newsletter_form').submit(function () {

	var action = $(this).attr('action');

	$("#message-newsletter").slideUp(750, function () {
		$('#message-newsletter').hide();

		$('#submit-newsletter')
			.after('<i class="icon_loading loader newsletter"></i>')
			.attr('disabled', 'disabled');

		$.post(action, {
			// email_newsletter: $('#email_newsletter').val()
		},
			function (data) {
				document.getElementById('message-newsletter').innerHTML = data;
				$('#message-newsletter').slideDown('slow');
				$('#newsletter_form .loader').fadeOut('slow', function () {
					$(this).remove()
				});
				$('#submit-newsletter').removeAttr('disabled');
				if (data.match('success') != null) $('#newsletter_form').slideUp('slow');

			}
		);

	});
	return false;
});

// Jquery validate form register
// $('#submit-register').submit(function(){
//
// 		$("#message-register").slideUp(750,function() {
// 		$('#message-register').hide();
//
//  		$('#submit-register')
// 			.after('<i class="icon_loading loader register"></i>')
// 			.attr('disabled','disabled');
//
//
// 			}
// 		);
// });


// Jquery validate form contact
$('#submit-contact').click(function () {
	$('#contactform').validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			},
			message: "required",
		},
		messages: {
			name: "Please enter your full name.",
			email: {
				required: "Please enter your email address.",
				email: "Please enter a valid email address."
			},
			message: "Please enter your message.",
		},
		submitHandler: function (form) {
			form.submit();
		}
	});
})
