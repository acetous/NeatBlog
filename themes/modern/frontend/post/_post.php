<?php

echo '<h1>'. link_to($post->getTitle(), 'post_show', $post) .'</h1>';
echo markdown( $post->getRaw('content') );
