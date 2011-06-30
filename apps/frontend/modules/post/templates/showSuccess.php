<?php 
	use_javascript('comments');
	use_helper('Text');
	slot( 'title', $post->getTitle() );
	slot( 'design_type', 'small' ); 
?>

<div class="content wrapper">

<div class="annotation"><?php echo __('at'); ?> <?php echo $post->getCreatedAt(); ?></div>

<div class="post">
	<?php echo $post->getMicropost() ? '<h1>'.$post.'</h1>' : ''; ?>
	<?php echo markdown( $sf_data->getRaw('post')->getContent() ); ?>
</div>

<div class="social-integration">
	<h2><?php echo __('Socialize'); ?></h2>
	<?php include_partial('socialize', array('url' => $post->getPermaLink(), 'width' => 290)); ?>
	<div class="social" style="width:500px;">
		<?php echo __('Permalink'); ?>: <?php echo link_to($post->getPermaLink(), $post->getPermaLink()); ?>
	</div>
	<br clear="both" />
</div>

<div class="comments">
	<a name="comments"></a>
	<h2><?php echo sizeof($post->getComments()) == 0 ? __('No Comments') : sizeof($post->getComments()).' '.__('Comments'); ?></h2>
	<?php foreach ($post->getComments() as $comment) : ?>
		<div class="annotation rightfloat"><?php echo $comment->getCreatedAt(); ?></div>
		<div class="comment">
			<p class="author"><?php echo strlen($comment->getAuthor()) > 0 ? $comment->getAuthor() : __('Anonymous'); ?></p>
			<?php echo auto_link_text(simple_format_text($comment->getContent()), 'all', array('target' => '_blank', 'rel' => 'nofollow'), true); ?>
		</div>
	<?php endforeach; ?>
	
	<h2 style="margin-top:30px;"><a href="#" id="commentlink"><?php echo __('Write a comment'); ?></a></h2>
	<div id="commentform" style="display:none;">
		<h3 style="margin-top:30px;"><?php echo __('Write a comment'); ?></h3>
		<?php include_partial('comment/form', array('post' => $post, 'form' => $commentForm)); ?>
	</div>
</div>

</div>