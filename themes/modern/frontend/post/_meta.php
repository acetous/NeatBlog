<p class="post-meta"><small>

    <span class="label">
        <a href="<?php echo url_for('post_show', $post) ?>">
            <?php echo strftime('%e. %B', $post->getDateTimeObject('created_at')->format('U')); ?>
        </a>
    </span>
    &nbsp;
    <span class="label">
        <a href="<?php echo url_for('post_show', $post) ?>#comments">
            <?php echo sizeof($post->getComments()) .' '. (sizeof($post->getComments()) == 1 ? __('comment') : __('comments')); ?>
        </a>
    </span>
    
</small></p>