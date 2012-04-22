var mdConverter;
$(function() {
	
	if (window.page_type == 'post/edit') {
		mdConverter = new Showdown.converter();
		$('ul#tabs a').bind('click', function (e) {
			if (e.target.href.slice(e.target.href.indexOf('#')) == "#preview") {
				var content;
				if ($('input#blog_post_markdown').attr('checked')) {
					content = mdConverter.makeHtml(
							"# " + $('input#blog_post_title').attr('value') + "\n\n" +
							$('textarea#blog_post_content').attr('value')
					);
				} else {
					content = "<h1>" + $('input#blog_post_title').attr('value') + "</h1>\n" +
						$('textarea#blog_post_content').attr('value');
				}
				content = shortcodes_preview(content);
				$('div#preview')
					.empty()
					.append(content);
				
				// prettify code
				prettyPrint();
			}
		});
	} // post/edit
	
});