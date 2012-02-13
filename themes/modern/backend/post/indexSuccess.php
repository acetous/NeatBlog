<div class="page-header">
	<h1><?php echo __('Last Posts'); ?></h1>
</div>

<div class="row">
<div class="span12">

<table id="posts-table" class="table table-striped table-condensed">
<thead>
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('ID'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Actions'); ?></th>
	</tr>
</thead>
<tbody>
<?php foreach ($posts as $post) : ?>
	<tr>
		<td class="post-date"><?php echo $post->getDateTimeObject('created_at')->format('d.m.'); ?></td>
		<td><?php echo $post->getId(); ?></td>
		<td class="post-title">
			<?php echo link_to($post->getRaw('title'), 'post_edit', $post); ?>
		</td>
		<td class="post-actions">
			<?php echo link_to(($post->getPublished() ? __('<i class="icon-ok icon-white"></i>') : __('<i class="icon-lock"></i>')), 'post_publish', $post, array('method' => 'put', 'class' => $post->getPublished() ? 'btn btn-small btn-success' : 'btn btn-small')) ?>
			<?php echo link_to('<i class="icon-trash icon-white"></i>', 'post_delete', $post, array('method' => 'delete', 'confirm' => __('Really delete?'), 'class' => 'btn btn-small btn-danger')) ?>
		</td>
	</tr>
<?php endforeach;?>
</tbody>
</table>

</div></div>