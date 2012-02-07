<div class="row">
<div class="span16">

<h1><?php echo __('Last Posts'); ?></h1>
<br />
<table class="zebra-striped">
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('ID'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Actions'); ?></th>
	</tr>
<?php foreach ($posts as $post) : ?>
	<tr>
		<td class="post-date"><?php echo $post->getDateTimeObject('created_at')->format('d.m.'); ?></td>
		<td><?php echo $post->getId(); ?></td>
		<td class="post-title">
			<?php echo link_to($post->getTitle(), 'post_edit', $post); ?>
		</td>
		<td class="post-actions">
			<?php echo link_to(($post->getPublished() ? __('Published') : __('Private')), 'post_publish', $post, array('method' => 'put', 'class' => $post->getPublished() ? 'btn tiny success' : 'btn tiny')) ?>
			<?php echo link_to(__('Delete'), 'post_delete', $post, array('method' => 'delete', 'confirm' => __('Really delete?'), 'class' => 'btn tiny danger')) ?>
		</td>
	</tr>
<?php endforeach;?>
</table>

</div></div>