<?php 
	use_helper('Text');
	use_helper('Pagination');
	
	// fix for locales
	setlocale(LC_ALL, sfConfig::get('app_view_locale', null));
?>
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
			$currentDate = strftime('%B', $post->getDateTimeObject('created_at')->format('U')); 
			if ($lastDate != $currentDate) : 
		?>
		<tr>
			<td class="post-date"><?php echo $currentDate; ?></td>
		</tr>
		<?php $lastDate = $currentDate; endif; ?>
		<?php include_component('post', 'preview', array(
			'post' => $post
		)); ?>
	<?php endforeach;?>
	</table>
	<?php echo pager_navigation($postPager, url_for('homepage', array('p_page' => 'PAGE'))); ?>
<?php endif; ?>

<div id="social-integration">
	<br />
	<h2><?php echo __('Socialize'); ?></h2>
	<?php include_partial('socialize', array('url' => url_for('@homepage', true), 'width' => 490)); ?>
	<br clear="both" />
	<div class="social">
		<a href="<?php echo url_for('feed'); ?>" class="button primary"><span class="rss icon"></span><?php echo __('Read this as RSS'); ?></a>
	</div>
	<br clear="both" />
</div>

</div>

<div id="shortpost-wrapper">

<h2><?php echo __('Short'); ?></h2>

	<table class="microposts">
	<?php 
		$lastDate = "";
		foreach ($microposts as $micropost) :
	?>
		<?php
			$currentDate = strftime('%e. %B', $micropost->getDateTimeObject('created_at')->format('U')); 
			if ($lastDate != $currentDate) :
		?>
		<tr>
			<td class="micropost-date"><?php echo $currentDate; ?></td>
		</tr>
		<?php $lastDate = $currentDate; endif; ?>
		<?php include_component('post', 'micropost', array(
			'post' => $micropost
		)); ?>
	<?php endforeach;?>
	</table>
	<?php echo pager_navigation($micropostPager, url_for('homepage', array('mp_page' => 'PAGE'))); ?>
</div>


<div class="annotation">
	<?php echo link_to(image_tag('eye', array('alt' => __('Mark all comments read'))), 'comments_read'); ?>
</div>