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
					$(this).find('.post-meta span.label').first().addClass('success');
			});
		}
		localStorage.setItem(key, $('div.row > div').first().attr('id'));
	}
});