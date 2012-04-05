<div class="page-header">
	<h1><?php echo __('Dashboard'); ?></h1>
</div>

<div class="row">
	<div class="span12">
		<h2><?php echo __('Last Posts'); ?></h2>
		
		<?php if (sizeof($posts) == 0) : ?>
			<div class="alert alert-info">
				<p><strong><?php echo __('No posts found.'); ?></strong> <?php echo __('It seemes there are no posts.'); ?></p>
				<div class="alert-actions">
					<a class="btn small" href="<?php echo url_for('post_new'); ?>"><?php echo __('Write your first post!'); ?></a>
				</div>
			</div>
		<?php else : ?>
			<?php include_partial('list', array('posts' => $posts)); ?>
		<?php endif; ?>
	</div>
</div>

<div class="row">
	<div class="span6">
		<h2><?php echo __('New Comments'); ?></h2>
		<?php if (sizeof($comments) == 0) : ?>
			<div class="alert alert-info">
				<p><strong><?php echo __('No comments yet.'); ?></strong> <?php echo __('Better write something interesing, huh?'); ?></p>
			</div>
		<?php else : ?>
			<?php include_partial('comment/list', array('comments' => $comments)); ?>
		<?php endif; ?>
	</div>
	
	<div class="span6">
		<h2><?php echo __('New Spam'); ?></h2>
		<?php if (sizeof($spam) == 0) : ?>
			<div class="alert alert-info">
				<p><strong><?php echo __('No new spam.'); ?></strong> <?php echo __("You're lucky!"); ?></p>
				<?php if ($totalSpam > 0) : ?>
					<p><?php echo sprintf(__('But there are %s comments marked as spam in total.'), '<strong>'.$totalSpam.'</strong>'); ?></p>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<?php include_partial('comment/list', array('comments' => $spam)); ?>
		<?php endif; ?>
	</div>
</div>