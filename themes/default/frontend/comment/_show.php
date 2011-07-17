<div class="annotation rightfloat"><?php echo $comment->getCreatedAt(); ?></div>
<div class="comment">
	<p class="author"><?php echo strlen($comment->getAuthor()) > 0 ? $comment->getAuthor() : __('Anonymous'); ?></p>
	<?php echo auto_link_text(simple_format_text($comment->getContent()), 'all', array('target' => '_blank', 'rel' => 'nofollow'), true); ?>
</div>