<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $sf_user->getCulture() ?>" lang="<?php echo $sf_user->getCulture() ?>">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<title><?php echo (get_slot('title') ? get_slot('title') . ' | ' : '') . sfConfig::get('app_details_name') ?></title>
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $sf_request->getUriPrefix() . $sf_request->getRelativeUrlRoot() . url_for('feed'); ?>" />
	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
	<?php echo sfConfig::get('app_other_tracking'); ?>
</head>
<body class="<?php echo get_slot('page_type'); ?>">
	<div id="header">
		<?php include_partial('content/header'); ?>
	</div>
	<div id="outer-wrapper">
		<?php echo $sf_content; ?>
		<br clear="both" style="display:none;" />
	</div>
	<div id="footer">
		<?php include_partial('content/footer'); ?>
	</div>
</body>
</html>