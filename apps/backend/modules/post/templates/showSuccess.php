<div class="annotation">vom <?php echo $post->getCreatedAt(); ?> - <?php echo $post->getViews(); ?> Besucher</div>
<div class="annotation post-actions">
	<?php echo link_to(($post->getPublished() ? image_tag('public') : image_tag('private')), 'post_publish', $post, array('method' => 'put')) ?>
	<?php echo link_to(image_tag('edit'), 'post_edit', $post) ?>
	<?php echo link_to(image_tag('delete'), 'post_delete', $post, array('method' => 'delete', 'confirm' => 'Sicher?')) ?>
</div>

<div class="post">
	<?php echo markdown($post->getContent()); ?>
</div>