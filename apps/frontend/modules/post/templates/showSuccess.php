<div class="annotation"><?php echo __('at'); ?> <?php echo $post->getCreatedAt(); ?></div>

<div class="post">
	<?php echo $post->getMicropost() ? '<h1>'.$post.'</h1>' : ''; ?>
	<?php echo markdown( $sf_data->getRaw('post')->getContent() ); ?>
</div>

<?php slot( 'title', $post->getTitle() ); ?>