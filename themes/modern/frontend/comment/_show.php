<?php use_helper('Text'); ?>

<?php echo auto_link_text(simple_format_text($comment->getContent()), 'all', array('target' => '_blank', 'rel' => 'nofollow'), true); ?>
<p><small>
    <span class="label">
        <?php echo strlen($comment->getAuthor()) > 0 ? $comment->getAuthor() : __('Anonymous'); ?>
        &mdash;
        <?php echo $comment->getCreatedAt(); ?>
    </span>
</p></small>
