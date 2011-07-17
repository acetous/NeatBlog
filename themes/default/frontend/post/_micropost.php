<tr>
	<td class="micropost-content">
		<?php echo markdown( $post->getRaw('content') ); ?>
	</td>
	<td class="micropost-info">
		<div class="commentlink <?php echo $hasNewComments ? 'new' : ''; ?>">
			<a href="<?php echo url_for('post_show', $post); ?>#comments"><?php echo '('.sizeof($post->getComments()).')'; ?></a>
		</div>
	</td>
</tr>