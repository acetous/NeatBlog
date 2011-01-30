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
			<td class="post-title"><?php echo link_to($post->getTitle(), 'post_show', $post); ?></td>
		</tr>
	<?php endforeach;?>
	</table>
<?php endif; ?>

<?php 
		$currentMonth = 0;
		foreach ($microposts as $micropost) :
			if ($currentMonth != $micropost->getDateTimeObject('created_at')->format('n')) {
				echo empty($currentMonth) ? '' : '</table>';
				$currentMonth = $micropost->getDateTimeObject('created_at')->format('n');
				
				echo '<table class="microposts">';
			}
	?>
		<tr>
			<td class="micropost-date">
				<?php echo link_to($micropost->getDateTimeObject('created_at')->format('d.m.'), 'post_show', $micropost); ?> »
			</td>
			<td class="micropost-content">
				<?php echo markdown( $micropost->getRaw('content') ); ?>
			</td>
		</tr>
	<?php endforeach;?>
	</table>