<?php use_helper('Text'); ?>

<div class="page-header">
	<?php echo link_to('<i class="icon-trash icon-white"></i> '.__('Delete all spam'), 'comment_deleteSpam', array(), array('class' => 'btn btn-danger btn-large pull-right', 'method' => 'delete', 'confirm' => __('Are you sure?')))?>
	<h1><?php echo __('Current Spam'); ?> <small>(<?php echo sizeof($comments); ?>)</small></h1>
</div>

<div class="row">
<div class="span12">

<?php if (sizeof($comments) == 0) : ?>
	<div class="well"><?php echo __('Hooray! No spam!'); ?></div>
<?php else : ?>
	<?php include_component('comment', 'list', array('comments' => $comments)); ?>
<?php endif; ?>

</div>
</div>