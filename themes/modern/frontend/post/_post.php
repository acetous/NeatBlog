<?php

echo '<h1>'. link_to($post->getRaw('title'), 'post_show', $post) .'</h1>';
echo $post->getMarkdown() ? markdown( $post->getRaw('content') ) : $post->getRaw('content');