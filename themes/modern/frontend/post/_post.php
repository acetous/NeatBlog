<?php

use_helper('Shortcode');

echo '<h1>'. link_to($post->getRaw('title'), 'post_show', $post) .'</h1>';
$post_content = $post->getMarkdown() ? markdown( $post->getRaw('content') ) : $post->getRaw('content');
echo do_shortcodes($post_content);