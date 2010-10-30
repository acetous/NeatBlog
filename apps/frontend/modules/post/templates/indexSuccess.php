<?php if (sizeof($posts) == 0) : ?>

	<p>Keine Posts vorhanden.</p>

<?php else : ?>

	<h3><?php echo date('Y'); ?></h3>
	<?php 
		$currentMonth = 0;
		$currentYear = date('Y');
		foreach ($posts as $post) :
			if ($currentMonth != $post->getDateTimeObject('created_at')->format('n')) {
				echo empty($currentMonth) ? '' : '</table>';
				$currentMonth = $post->getDateTimeObject('created_at')->format('n');
				
				if ($currentYear != $post->getDateTimeObject('created_at')->format('Y')) {
					$currentYear = $post->getDateTimeObject('created_at')->format('Y');
					echo '<h3>'.$currentYear.'</h3>'; 
				}
				
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