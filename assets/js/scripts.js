$(document).ready(function(){
	$.baztyFooter({
		header:'.bs-docs-header',
		content:'.bs-docs-section',
		footer:'.bs-docs-footer',
		delta:200
	});
	$('.background-loader, .loaderGif').hide();
	$('#formUploader').submit(function(e){
		$('.background-loader, .loaderGif').fadeIn(500);
	});
	$('form').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			$(this).submit();
		}
	});
});
