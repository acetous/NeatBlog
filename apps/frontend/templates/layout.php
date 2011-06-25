<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $sf_user->getCulture() ?>" lang="<?php echo $sf_user->getCulture() ?>">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<title><?php echo (get_slot('title') ? get_slot('title') . ' | ' : '') . sfConfig::get('app_details_name') ?></title>
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $sf_request->getUriPrefix() . $sf_request->getRelativeUrlRoot(); ?>/feed.rss" />
	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
	<?php echo sfConfig::get('app_other_tracking'); ?>
</head>
<body>
	<div id="header" class="<?php echo get_slot('design_type'); ?>">
		<h1><?php echo link_to(sfConfig::get('app_details_name'), 'homepage'); ?></h1>
	</div>
	<div id="outer-wrapper">
		<?php echo $sf_content ?>
		<br clear="both" style="display:none;" />
	</div>
	<div id="footer" class="wrapper <?php echo get_slot('design_type'); ?>">
		<div class="left">
			<?php 
				$contact = sfConfig::get('app_details_contact');
				if (!empty($contact)) :
			?>
			<?php echo __('Visit me on'); ?><br />
			<?php 
				$contact = explode('|', $contact);
				array_walk($contact, create_function('&$el, $i', '$el = explode(":", $el, 2);'));
				foreach ($contact as $i => $entry) {
					echo '<a href="'.$entry[1].'">'.$entry[0].'</a>' . (isset($contact[$i+1]) ? ' | ' : '<br />');
				}
			?>
			<?php endif; ?>
		</div>
		<div class="right">
			powered by <a href="http://github.com/acetous/NeatBlog">&lt;NeatBlog&gt;</a><br />
			<?php if (strlen(sfConfig::get('app_details_imprint')) > 0) echo link_to(__('Imprint'), 'content_imprint'); ?>
		</div>
	</div>
</body>
</html>
