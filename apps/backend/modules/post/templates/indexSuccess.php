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
		<td class="post-actions">
			<?php echo link_to(($post->getPublished() ? image_tag('public') : image_tag('private')), 'post_publish', $post, array('method' => 'put')) ?>
			<?php echo link_to(image_tag('edit'), 'post_edit', $post) ?>
			<?php echo link_to(image_tag('delete'), 'post_delete', $post, array('method' => 'delete', 'confirm' => 'Sicher?')) ?>
		</td>
	</tr>
<?php endforeach;?>
</table>