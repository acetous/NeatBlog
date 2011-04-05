<h2><?php echo __('Posts'); ?></h2>
<?php if (sizeof($posts) == 0) : ?>

	<p><?php echo __('No posts found.'); ?></p>

<?php else : ?>
	<?php 
		$currentMonth = 0;
		foreach ($posts as $post) :
			if ($currentMonth != $post->getDateTimeObject('created_at')->format('n')) {
				echo empty($currentMonth) ? '' : '</table>';
				$currentMonth = $post->getDateTimeObject('created_at')->format('n');
				
				echo '<table class="posts">';
			}
	?>
		<tr>
			<td class="post-date"><?php echo $post->getDateTimeObject('created_at')->format('d.m.'); ?> »</td>
			<td class="post-title">
				<span class="rightfloat"><?php echo link_to('('.sizeof($post->getComments()).')', 'post_show', $post); ?></span>
				<?php echo link_to($post->getTitle(), 'post_show', $post); ?>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
<?php endif; ?>

<h2><?php echo __('Short'); ?></h2>

	<table class="microposts">
	<?php 
		foreach ($microposts as $micropost) :
	?>
		<tr>
			<td class="micropost-date">
				<?php echo $micropost->getDateTimeObject('created_at')->format('d.m.'); ?> »
			</td>
			<td class="micropost-content">
				<span class="rightfloat"><?php echo link_to('('.sizeof($micropost->getComments()).')', 'post_show', $micropost); ?></span>
				<?php echo markdown( $micropost->getRaw('content') ); ?>
			</td>
		</tr>
	<?php endforeach;?>
	</table>