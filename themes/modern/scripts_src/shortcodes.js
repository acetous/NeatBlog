function shortcodes_preview(text) {
	// [video]
	text = text.replace(/\[video.*\]/ig, function(str) {
		var regex = /\[video( \S+)( [a-z]+)?\]/i;
		var result = regex.exec(str);
		return '<div class="shortcode-video shortcode-preview span3 thumbnail" style="float:'+(result[2] || 'right')+';"></div>';
	});
	
	return text;
}