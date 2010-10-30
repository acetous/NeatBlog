<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $sf_user->getCulture() ?>" lang="<?php echo $sf_user->getCulture() ?>">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<title><?php echo sfConfig::get('app_details_name')?> | Backend</title>
	<link rel="shortcut icon" href="/favicon.ico" />
	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
</head>
<body>
	<h1><?php echo link_to(sfConfig::get('app_details_name').' | Backend', 'homepage'); ?></h1>
	<div id="menu" class="wrapper annotation">
		<?php echo link_to(__('New Post'), 'post_new'); ?>
	</div>
	<div id="content" class="wrapper">
		<?php echo $sf_content ?>
	</div>
	<div id="footer" class="wrapper">
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
		</div>
</body>
</html>