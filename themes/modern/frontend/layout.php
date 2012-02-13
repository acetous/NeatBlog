
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
	<?php include_metas() ?>
	
	<title><?php include_slot('title', 'acetous Blog'); ?></title>

	<meta name="robots" content="<?php echo get_slot('robots', 'index, follow'); ?>">
	
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $sf_request->getUriPrefix() . $sf_request->getRelativeUrlRoot() . url_for('feed'); ?>" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <?php 
        if (get_slot('page_type'))
            echo '<script>var page_type = "'.get_slot('page_type').'";</script>';
    ?>

    <link href="<?php echo stylesheet_path('/styles/modern/modern.min.css'); ?>" rel="stylesheet">
    <script src="<?php echo javascript_path('/scripts/modern/modern.min.js'); ?>"></script>

    
    <?php include_stylesheets() ?>
	<?php include_javascripts() ?>

  </head>

  <body>

    <?php include_component('content', 'header'); ?>

    <div class="container">
	
	  <?php echo $sf_content; ?>

      <footer>
        <?php include_partial('content/footer'); ?>
      </footer>

    </div> <!-- /container -->

    <?php echo sfConfig::get('app_other_tracking'); ?>

  </body>
</html>
