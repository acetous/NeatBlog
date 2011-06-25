<?php use_javascript('comments'); ?>
<?php use_helper('Text'); ?>
<?php slot( 'title', $post->getTitle() ); ?>

<div class="content wrapper">

<div class="annotation"><?php echo __('at'); ?> <?php echo $post->getCreatedAt(); ?></div>

<div class="post">
	<?php echo $post->getMicropost() ? '<h1>'.$post.'</h1>' : ''; ?>
	<?php echo markdown( $sf_data->getRaw('post')->getContent() ); ?>
</div>

<div class="annotation"><?php echo __('Permalink'); ?>: <?php echo link_to($post->getPermaLink(), $post->getPermaLink()); ?></div>

<div class="comments">
	<h3><?php echo sizeof($post->getComments()) == 0 ? __('No Comments') : sizeof($post->getComments()).' '.__('Comments'); ?></h3>
	<?php foreach ($post->getComments() as $comment) : ?>
		<div class="annotation"><?php echo __('at'); ?> <?php echo $comment->getCreatedAt(); ?></div>
		<div class="comment">
			<p class="author"><?php echo strlen($comment->getAuthor()) > 0 ? $comment->getAuthor() : __('Anonymous'); ?></p>
			<?php echo simple_format_text($comment->getContent()); ?>
		</div>
	<?php endforeach; ?>
	
	<h3 style="margin-top:30px;"><a href="#" id="commentlink"><?php echo __('Write a comment'); ?></a></h3>
	<div id="commentform" style="display:none;">
		<h3 style="margin-top:30px;"><?php echo __('Write a comment'); ?></h3>
		<?php include_partial('comment/form', array('post' => $post, 'form' => $commentForm)); ?>
	</div>
</div>

</div>