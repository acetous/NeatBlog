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

	<?php include_partial('list', array('posts' => $posts)); ?>

<?php endif; ?>

</div></div>