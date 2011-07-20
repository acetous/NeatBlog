<div class="item">
    <h3><?php echo __('About'); ?></h3>
    <?php echo sfConfig::get('app_details_about'); ?>
</div>
<div class="item">
    <h3><?php echo __('Follow'); ?></h3>
    <?php
		$contact = sfConfig::get('app_details_contact');
		if (!empty($contact)) :
	?>
	<?php
		$contact = explode('|', $contact);
		array_walk($contact, create_function('&$el, $i', '$el = explode(":", $el, 2);'));
		foreach ($contact as $i => $entry) {
			echo '<a href="'.$entry[1].'">'.$entry[0].'</a><br />';
		}
	?>
	<?php endif; ?>
</div>
<div class="item">
    <h3><?php echo __('Meta'); ?></h3>
	<?php if (strlen(sfConfig::get('app_details_imprint')) > 0) echo link_to(__('Imprint'), 'content_imprint'); ?>
</div>

<div class="copyright">
    powered by <a href="http://github.com/acetous/NeatBlog">&lt;NeatBlog&gt;</a>
</div>

