<div class="page-header">
	<h1><?php echo __('Last Comments'); ?></h1>
</div>

<div class="row">
	<div class="span12">
		<?php include_component('comment', 'list', array('comments' => $comments)); ?>
	</div>
</div>