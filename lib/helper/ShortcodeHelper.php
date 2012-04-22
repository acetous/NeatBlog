<?php

function do_shortcodes($text) {
	$text = Shortcodes_Video::apply($text);
	
	return $text;
}