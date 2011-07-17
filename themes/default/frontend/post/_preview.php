<tr>
	<td class="post-content">
		<div class="post-title"><?php echo link_to($post->getTitle(), 'post_show', $post); ?></div>
		<div class="post-content">
			<?php echo markdown($post->getExcerpt() . link_to(__('Read more...'), 'post_show', $post)); ?>
		</div>
	</td>
	<td class="post-info">
		<div class="commentlink <?php echo $hasNewComments ? 'new' : ''; ?>">
			<a href="<?php echo url_for('post_show', $post) ?>#comments"><?php echo '('.sizeof($post->getComments()).')'; ?></a>
		</div>
	</td>
</tr>