<?php

function do_shortcodes($text) {
	$text = Shortcodes_Video::apply($text);

	return $text;
}

function do_shortcodes_feed($text) {
   $text = Shortcodes_Video::applyFeed($text);

   return $text;
}
