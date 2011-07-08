<?php header('Content-type: application/rss+xml'); ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>

<rss version="2.0">
	<channel>
		<title><?php echo sfConfig::get('app_details_name'); ?></title>
		<link><?php echo $sf_request->getUriPrefix() . $sf_request->getRelativeUrlRoot(); ?></link>
		<description><?php echo trim(sfConfig::get('app_rss_description')); ?></description>
		<generator>NeatBlog (https://github.com/acetous/NeatBlog)</generator>
		
		<?php echo $sf_content; ?>
		
	</channel>
</rss>