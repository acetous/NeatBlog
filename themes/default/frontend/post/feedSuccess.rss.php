<?php 
	use_helper('Text');
	$posts_raw = $sf_data->getRaw('posts');
?>
<?php foreach ($posts as $index => $post) : ?>
	<item>
		<title><?php echo $post->getTitle(); ?></title>
		<link><?php echo $post->getPermaLink(); ?></link>
		<description><?php echo ($post->getMicropost() ? 
			markdown($posts_raw[$index]->getContent()) : 
			markdown($posts_raw[$index]->getExcerpt() .' '. link_to(__('Read more...'), 'post_show', $post))); 
?></description>
		<guid><?php echo $post->getPermaLink(); ?></guid>
	</item>
<?php endforeach; ?>
