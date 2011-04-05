$(function(){
	$('a#commentlink').click(function(event) {
		$('div#commentform').show();
		$(this).parent('h3').hide();
		event.preventDefault();
	});
});