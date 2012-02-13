<?php slot('title', $post->getTitle()); ?>
<?php use_javascript('/scripts/modern/autoresize.jquery.min.js'); ?>


<div class="row">
    <div class="span12">
        <?php include_partial('post', array('post' => $post)); ?>

        <p class="post-meta"><small>

            <span class="label">
                <?php echo strftime('%e. %B', $post->getDateTimeObject('created_at')->format('U')); ?>
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
			<br />
			<br />
		</div>
		<h2><?php echo __('Comments'); ?></h2>
	</div>
</div>
<div class="row">
	<div class="span6" id="comments">
        <?php foreach ($post->getComments() as $comment) : ?>
		    <?php include_partial('comment/show', array('comment' => $comment))?>
	    <?php endforeach; ?>
    </div>
    <div class="span6" id="comment-form">
        <?php include_partial('comment/form', array('post' => $post, 'form' => $commentForm)); ?>
	</div>
</div>

<script type="text/javascript">
$(function() {
	// commentform-toggle
	$('#comment-form').hide();
	$('#comments').removeClass('span6').addClass('span12');
	$('#comment-form-hint').click(function() {
		$('#comment-form').show();
		$('#comment-form-hint').hide();
		$('#comments').removeClass('span12').addClass('span6');
	});
	$('input[type="reset"]').click(function() {
		$('#comment-form').hide();
		$('#comment-form-hint').show();
		$('#comments').removeClass('span6').addClass('span12');
	});
	
	// activate autoresize
	$('textarea').autoResize();
	// trigger autoresize for initial height
	$('textarea').each(function() { $(this).change(); });
});
</script>
