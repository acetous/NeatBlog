<?php 
	slot('title', strip_tags($post->getRaw('title')));
	slot('page_type', 'post/show');
	
	use_helper('Shortcode');
?>


<div class="row">
    <div class="span12">
        <div class="page-header"><h1><?php echo link_to($post->getRaw('title'), 'post_show', $post); ?></h1></div>
		<?php 
			$post_content = $post->getMarkdown() ? markdown( $post->getRaw('content') ) : $post->getRaw('content');
			echo do_shortcodes($post_content);
		?>

		<div class="clearfix"></div>
        <p class="post-meta"><small>

            <span class="label">
                <?php echo strftime('%e. %B', $post->getDateTimeObject('published_at')->format('U')); ?>
            </span>
            &nbsp;
            <span class="label">
                Permalink: <a href="<?php echo $post->getPermalink(); ?>" style="text-transform: none;"><?php echo $post->getPermalink(); ?></a>
            </span>
            
        </small></p>
        
        <hr />
    </div>
</div>

<div class="row clearfix">
	<div class="span12">
		<div id="comment-form-hint" class="pull-right">
			<a class="btn btn-large btn-primary"><?php echo __('Write a comment'); ?></a>
		</div>
		<h2><?php echo __('Comments'); ?></h2>
		<br /><br />
	</div>
</div>
<div class="row">
	<div class="span6" id="comments">
		<?php if (sizeof($post->getComments()) > 0) : ?>
	       <?php foreach ($post->getComments() as $comment) : ?>
			    <?php include_partial('comment/show', array('comment' => $comment))?>
		   <?php endforeach; ?>
	   <?php else : ?>
		   <div class="well"><?php echo __('No comments yet.'); ?></div>
	   <?php endif; ?>
    </div>
    <div class="span6" id="comment-form">
        <?php include_partial('comment/form', array('post' => $post, 'form' => $commentForm)); ?>
	</div>
</div>
