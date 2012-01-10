$(function(){
	// dropdown menu
	$('.topbar').dropdown();
	
	// add submenu to dropdown
	$('.topbar li.submenu').each(function() {
		// add divider
		$(this).children('ul').first().append('<li class="divider"></li>');
		
		$(this).children('a').click(function() {
			$('.topbar li.submenu a').removeClass('active');
			$('.topbar li.submenu ul').hide();
			$(this).addClass('active');
			$(this).siblings('ul').first().show();
			return false;
		});
	});
	$('.topbar ul.nav').click(function() {
		$('.topbar li.submenu a').removeClass('active');
		$('.topbar li.submenu ul').hide();
	});
	
	// Feature: "New Posts"
	if (window.page_type == "homepage" && window.location.search == "" && Modernizr.localstorage) {
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