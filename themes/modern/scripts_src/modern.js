$(function(){
	// prettyprint
	prettyPrint();
	
	// textarea autoresize
	$('textarea').autoResize();
	$('textarea').each(function() { $(this).change(); });
	
	// Feature: "Unread Posts"
	if (window.page_type == "post/index" && window.location.search == "" && Modernizr.localstorage) {
		var key = 'lastread';
		if (null != localStorage.getItem(key)) {
			var read = false;
			$('div.row > div').each(function() {
				if (localStorage.getItem(key) == $(this).attr('id'))
					read = true;
				
				if (!read)
					$(this).find('.post-meta span.label').first().addClass('label-warning');
			});
		}
		localStorage.setItem(key, $('div.row > div').first().attr('id'));
	}
	
	// Commentform-toggle
	if (window.page_type == "post/show") {
		$('#comment-form').hide();
		$('#comments').removeClass('span6').addClass('span12');
		$('#comment-form-hint').click(function() {
			$('#comment-form').show();
			$('#comment-form-hint').hide();
			$('#comments').removeClass('span12').addClass('span6');
		});
		$('input[type="reset"]').click(function() {
			$('#comment-form').hide();
			$('#comment-form-hint').show();
			$('#comments').removeClass('span6').addClass('span12');
		});
	}
});