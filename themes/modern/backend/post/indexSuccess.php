<div class="page-header">
	<?php if($query = sfContext::getInstance()->getRequest()->getGetParameter('query')) : ?>
		<h1><?php echo __('Search for'); ?> <em><?php echo $query; ?></em> <small><?php echo sizeof($posts); ?> <?php echo __('Hits'); ?></small></h1>
	<?php else : ?>
		<h1><?php echo __('Last Posts'); ?></h1>
	<?php endif; ?>
</div>

<div class="row">
<div class="span12">

<?php if (sizeof($posts) == 0) : ?>

        <div class="alert alert-error">
        <p><strong><?php echo __('No posts found.'); ?></strong> <?php echo __('It seemes no posts match your criteria. Reasons may be'); ?></p>
        <ul>
            <li><?php echo __('There are no posts at all. Write one!'); ?></li>
            <li><?php echo __('Your Post-ID oder URL was invalid.'); ?></li>
            <li><?php echo __('There are no posts matching your search criteria.'); ?></li>
        </ul>
        <div class="alert-actions">
          <a class="btn small" href="<?php echo url_for('post/index'); ?>"><?php echo __('Return to index'); ?></a>
        </div>
      	</div>

<?php else : ?>

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

<?php endif; ?>

</div></div>