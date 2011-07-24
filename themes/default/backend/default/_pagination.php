<div class="pagination">

<?php if ($current == $first) : ?>

<a href="<?php echo $uri['next']; ?>" class="button"><?php echo __('Next Page'); ?></a>

<?php elseif ($current == $last) : ?>

<a href="<?php echo $uri['first']; ?>" class="button left primary"><?php echo __('First Page'); ?>
</a><a href="<?php echo $uri['previous']; ?>" class="button right"><?php echo __('Previous Page'); ?></a>

<?php else : ?>

<a href="<?php echo $uri['first']; ?>" class="button left primary"><?php echo __('First Page'); ?>
</a><a href="<?php echo $uri['previous']; ?>" class="button middle"><?php echo __('Previous Page'); ?>
</a><a href="<?php echo $uri['next']; ?>" class="button right"><?php echo __('Next Page'); ?></a>

<?php endif; ?>

</div>

