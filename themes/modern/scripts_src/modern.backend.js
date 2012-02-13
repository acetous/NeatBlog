var mdConverter;
$(function() {
	
	if (window.page_type == 'post/edit') {
		mdConverter = new Showdown.converter();
		$('ul#tabs a').bind('click', function (e) {
			if (e.target.href.slice(e.target.href.indexOf('#')) == "#preview") {
				$('div#preview')
					.empty()
					.append(
						mdConverter.makeHtml(
								"# " + $('input#blog_post_title').attr('value') + "\n\n" +
								$('textarea#blog_post_content').attr('value')
						)
					);
			}
		});
	} // post/edit
	
});