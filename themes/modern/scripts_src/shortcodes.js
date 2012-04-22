function shortcodes_preview(text) {
	// [video]
	text = text.replace(/\[video .*\]/ig, '<div class="shortcode-video shortcode-preview span3 thumbnail"></div>');
	
	return text;
}