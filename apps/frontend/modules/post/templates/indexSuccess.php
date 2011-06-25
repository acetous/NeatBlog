<?php 
	use_helper('Text');
	$posts_raw = $sf_data->getRaw('posts');
?>

<div id="article-wrapper">
<h2><?php echo __('Posts'); ?></h2>
<?php if (sizeof($posts) == 0) : ?>

	<p><?php echo __('No posts found.'); ?></p>

<?php else : ?>
	<table class="posts">
	<?php foreach ($posts as $index => $post) :	?>
		<tr>
			<td class="post-content">
				<div class="post-title"><?php echo link_to($post->getTitle(), 'post_show', $post); ?></div>
				<div class="post-content">
					<?php echo markdown($posts_raw[$index]->getExcerpt() . link_to(__('Read more...'), 'post_show', $post)); ?>
				</div>
			</td>
			<td class="post-info">
				<span><?php echo $post->getDateTimeObject('created_at')->format('d.m.'); ?></span>
				<div class="commentlink <?php $postNewComments[$post->getId()] ? 'new' : ''; ?>">
					<?php echo link_to('('.sizeof($post->getComments()).')', 'post_show', $post); ?>
				</div>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
<?php endif; ?>
</div>

<div id="shortpost-wrapper">
<h2><?php echo __('Short'); ?></h2>

	<table class="microposts">
	<?php 
		$lastDate = "";
		foreach ($microposts as $micropost) :
	?>
		<?php if ($lastDate != $micropost->getDateTimeObject('created_at')->format('d.m.')) : ?>
		<tr>
			<td class="micropost-date"><?php echo $micropost->getDateTimeObject('created_at')->format('d.m.'); ?></td>
		</tr>
		<?php $lastDate = $micropost->getDateTimeObject('created_at')->format('d.m.'); endif; ?>
		<tr>
			<td class="micropost-content">
				<?php echo markdown( $micropost->getRaw('content') ); ?>
			</td>
			<td class="micropost-info">
				<div class="commentlink <?php echo $postNewComments[$micropost->getId()] ? 'new' : ''; ?>">
					<?php echo link_to('('.sizeof($micropost->getComments()).')', 'post_show', $micropost); ?>
				</div>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
</div>