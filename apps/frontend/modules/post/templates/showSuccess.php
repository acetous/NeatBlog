<div class="annotation"><?php echo __('at'); ?> <?php echo $post->getCreatedAt(); ?></div>

<div class="post">
	<?php echo markdown($post->getContent()); ?>
</div>

<?php slot( 'title', $post->getTitle() ); ?>