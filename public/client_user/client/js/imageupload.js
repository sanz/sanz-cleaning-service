$(function() {
	$('#profile').addClass('dragging').removeClass('dragging');
});

$('#profile').on('dragover', function() {
	$('#profile').addClass('dragging')
}).on('dragleave', function() {
	$('#profile').removeClass('dragging')
}).on('drop', function(e) {
	$('#profile').removeClass('dragging hasImage');

	if (e.originalEvent) {
		var file = e.originalEvent.dataTransfer.files[0];
    	var reader = new FileReader();

		reader.readAsDataURL(file);	
		reader.onload = function(e) {
			$('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');
		}
  	}
})

$('#profile').on('click', function(e) {
	$('#mediaFile').click();
});

window.addEventListener("dragover", function(e) {
	e = e || event;
	e.preventDefault();
}, false);

window.addEventListener("drop", function(e) {
	e = e || event;
	e.preventDefault();
}, false);

$('#mediaFile').change(function(e) {
	var input = e.target;
	if (input.files && input.files[0]) {
		var file = input.files[0];
		var reader = new FileReader();

		reader.readAsDataURL(file);
		reader.onload = function(e) {
			$('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');
		}
	}
})