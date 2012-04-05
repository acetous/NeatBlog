<p>
<?php echo sfConfig::get('app_details_about'); ?>
</p>
<p>
	<small><?php if (strlen(sfConfig::get('app_details_imprint')) > 0) echo link_to(__('Imprint'), 'content_imprint'); ?></small>
</p>


<p style="text-align: right;"><small>powered by <a href="http://github.com/acetous/NeatBlog">&lt;NeatBlog&gt;</a></small></p>
