<?php use_helper('Text'); ?>

<div class="well comment">	
	<h4><?php echo strlen($comment->getAuthor()) > 0 ? $comment->getAuthor() : __('Anonymous'); ?>
	<small>&mdash; <?php echo $comment->getCreatedAt(); ?></small></h4>
	<?php echo auto_link_text(simple_format_text($comment->getContent()), 'all', array('target' => '_blank', 'rel' => 'nofollow'), true); ?>
</div>
