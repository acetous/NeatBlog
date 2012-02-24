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
		<td><?php echo $post->getDateTimeObject('created_at')->format('d.m.'); ?></td>
		<td><?php echo $post->getId(); ?></td>
		<td class="post-title">
			<?php echo link_to($post->getRaw('title'), 'post_edit', $post); ?>
		</td>
		<td>
			<div class="btn-group">
				<?php echo link_to(($post->getPublished() ? __('<i class="icon-ok icon-white"></i>') : __('<i class="icon-lock"></i>')), 'post_publish', $post, array('method' => 'put', 'class' => $post->getPublished() ? 'btn btn-small btn-success' : 'btn btn-small')) ?>
				<?php echo link_to('<i class="icon-trash icon-white"></i>', 'post_delete', $post, array('method' => 'delete', 'confirm' => __('Really delete?'), 'class' => 'btn btn-small btn-danger')) ?>
			</div>
		</td>
	</tr>
<?php endforeach;?>
</tbody>
</table>