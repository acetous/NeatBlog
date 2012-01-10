<div class="row">
    <div class="span16">
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
    </div>
</div>

<div class="row">
    <div class="span8">
        <h2><?php echo __('Comments'); ?></h2>
        <?php foreach ($post->getComments() as $comment) : ?>
		    <?php include_partial('comment/show', array('comment' => $comment))?>
	    <?php endforeach; ?>
    </div>
    <div class="span8">
        <h2><?php echo __('Write a comment'); ?></h2>
        <?php include_partial('comment/form', array('post' => $post, 'form' => $commentForm)); ?>
    </div>
</div>
