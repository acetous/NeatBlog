<?php 
	use_helper('Text');
	slot('title', strip_Tags($post->getTitle()));
	slot('page_type', 'post_show'); 
?>

<div class="content wrapper">

<div class="annotation"><?php echo __('at'); ?> <?php echo $post->getCreatedAt(); ?></div>

<div class="post">
	<?php echo $post->getMicropost() ? '<h1>'.$post.'</h1>' : ''; ?>
	<?php echo markdown( $sf_data->getRaw('post')->getContent() ); ?>
</div>

<div class="social-integration">
	<h2><?php echo __('Socialize'); ?></h2>
	<?php include_partial('socialize', array('url' => $post->getPermaLink(), 'width' => 490)); ?>
	<br clear="both" />
	<div class="social" style="width:890px;">
		<?php echo __('Permalink'); ?>: <?php echo link_to($post->getPermaLink(), $post->getPermaLink()); ?>
	</div>
	<br clear="both" />
</div>

<div class="comments">
	<a name="comments"></a>
	
	<a href="#writecomment" id="commentlink" class="button big"><?php echo __('Write a comment'); ?></a>
	<h2><?php echo sizeof($post->getComments()) == 0 ? __('No Comments') : sizeof($post->getComments()).' '.__('Comments'); ?></h2>
	<br clear="both" />
	
	<?php foreach ($post->getComments() as $comment) : ?>
		<?php include_partial('comment/show', array('comment' => $comment))?>
	<?php endforeach; ?>

	<a name="writecomment"></a>
	<div id="commentform">
		<h2><?php echo __('Write a comment'); ?></h2>
		<?php include_partial('comment/form', array('post' => $post, 'form' => $commentForm)); ?>
	</div>
</div>

</div>