<?php
	use_helper('Text');
   use_helper('Shortcode');
	$posts_raw = $sf_data->getRaw('posts');
?>
<?php foreach ($posts as $index => $post) : ?>
	<item>
		<title><?php echo strip_tags($post->getRaw('title')); ?></title>
		<link><?php echo $post->getPermaLink(); ?></link>
		<description><?php
      $post_content = $post->getMarkdown() ? markdown($posts_raw[$index]->getContent()) : $posts_raw[$index]->getContent();
      echo do_shortcodes_feed($post_content);
?></description>
		<guid><?php echo $post->getPermaLink(); ?></guid>
	</item>
<?php endforeach; ?>
