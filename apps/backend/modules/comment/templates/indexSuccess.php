<?php 
	use_helper('Pagination');
	use_helper('Text');
?>

<h2>Comments</h2>

<?php foreach ($commentPager->getResults() as $comment) : ?>
<div class="comment">
	<hr />
	<div class="info">
		<div class="rightfloat"><?php echo link_to(image_tag('delete'), 'comment_delete', $comment, array('method' => 'delete', 'confirm' => __('Are you sure?')))?></div>
		<b><?php echo $comment->getAuthor(); ?></b>
		<?php echo __('on'); ?>
		<?php echo link_to($comment->getBlogPost(), 'post_show', $comment->getBlogPost()); ?>
	</div>
	<?php echo auto_link_text(simple_format_text($comment->getContent()), 'all', array('target' => '_blank', 'rel' => 'nofollow'), true); ?>
</div>
<?php endforeach; ?>

<p><?php echo pager_navigation($commentPager, url_for('comments', array('page' => 'PAGE'))); ?></p>