$(function() {
	var home = 
	$("a").each(function(index, link) {
		if ($(link).attr("href") != undefined && $(link).attr("href").match(/\w+:\/\/.*/) != null && $(link).attr("href").indexOf(window.location.hostname) == -1) {
			$(link).attr("target", "_blank");
		}
	});
});