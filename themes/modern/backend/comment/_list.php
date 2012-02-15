<?php use_helper('Text'); ?>

<?php if (sizeof($comments) == 0) : ?>

<div class="well"><?php echo __('No comments yet.'); ?></div>

<?php else : ?>

<table class="table table-striped">
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($comments as $comment) : ?>
			<tr>
				<td>
					<strong><nobr><?php echo $comment->getAuthor() ? $comment->getAuthor() : __('Anonymous'); ?></nobr></strong>
				</td>
				<td>
					<?php echo auto_link_text(simple_format_text($comment->getContent()), 'all', array('target' => '_blank', 'rel' => 'nofollow'), true); ?>
					<span class="label"><?php echo link_to($comment->getBlogPost(), 'post_edit', $comment->getBlogPost()); ?></span>
				</td>
				<td>
					<nobr>
					<?php echo link_to('<i class="icon-trash icon-white"></i>', 'comment_delete', $comment, array('class' => 'btn btn-danger', 'method' => 'delete', 'confirm' => __('Are you sure?')))?>
					<?php echo link_to($comment->getSpam() ? '<i class="icon-heart"></i>' : '<i class="icon-ban-circle"></i>', 'comment_toggleSpam', $comment, array('class' => 'btn', 'method' => 'post'))?>
					</nobr>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php endif; ?>