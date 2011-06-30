<?php 
	use_helper('Text');
	use_helper('Pagination');
	$posts_raw = $sf_data->getRaw('posts');
	
	setlocale(LC_ALL, sfConfig::get('app_view_locale', null));
?>

<div class="annotation">
	<?php echo link_to(image_tag('rss', array('alt' => __('RSS-Feed'))), 'feed' ); ?>
</div>
<div id="article-wrapper">
<h2><?php echo __('Posts'); ?></h2>
<?php if (sizeof($posts) == 0) : ?>

	<p><?php echo __('No posts found.'); ?></p>

<?php else : ?>
	<table class="posts">
	<?php
		$lastDate = ""; 
		foreach ($posts as $index => $post) :
	?>
		<?php
			$currentDate = strftime('%B', $post->getDateTimeObject('created_at')->getTimestamp()); 
			if ($lastDate != $currentDate) : 
		?>
		<tr>
			<td class="post-date"><?php echo $currentDate; ?></td>
		</tr>
		<?php $lastDate = $currentDate; endif; ?>
		<tr>
			<td class="post-content">
				<div class="post-title"><?php echo link_to($post->getTitle(), 'post_show', $post); ?></div>
				<div class="post-content">
					<?php echo markdown($posts_raw[$index]->getExcerpt() . link_to(__('Read more...'), 'post_show', $post)); ?>
				</div>
			</td>
			<td class="post-info">
				<div class="commentlink <?php echo $postNewComments[$post->getId()] ? 'new' : ''; ?>">
					<a href="<?php echo url_for('post_show', $post) ?>#comments"><?php echo '('.sizeof($post->getComments()).')'; ?></a>
				</div>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<?php echo pager_navigation($postPager, url_for('homepage', array('p_page' => 'PAGE'))); ?>
<?php endif; ?>
</div>

<div id="shortpost-wrapper">
<h2><?php echo __('Short'); ?></h2>

	<table class="microposts">
	<?php 
		$lastDate = "";
		foreach ($microposts as $micropost) :
	?>
		<?php
			$currentDate = strftime('%e. %B', $micropost->getDateTimeObject('created_at')->getTimestamp()); 
			if ($lastDate != $currentDate) :
		?>
		<tr>
			<td class="micropost-date"><?php echo $currentDate; ?></td>
		</tr>
		<?php $lastDate = $currentDate; endif; ?>
		<tr>
			<td class="micropost-content">
				<?php echo markdown( $micropost->getRaw('content') ); ?>
			</td>
			<td class="micropost-info">
				<div class="commentlink <?php echo $postNewComments[$micropost->getId()] ? 'new' : ''; ?>">
					<a href="<?php echo url_for('post_show', $micropost); ?>#comments"><?php echo '('.sizeof($micropost->getComments()).')'; ?></a>
				</div>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<?php echo pager_navigation($micropostPager, url_for('homepage', array('mp_page' => 'PAGE'))); ?>
</div>


<div class="annotation">
	<?php echo link_to(image_tag('eye', array('alt' => __('Mark all comments read'))), 'comments_read'); ?>
</div>