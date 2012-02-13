
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
	<?php include_metas() ?>
	
	<title><?php include_slot('title', 'acetous Blog'); ?></title>

	<?php if (!has_slot('title')) : ?>
		<meta name="robots" content="noindex, follow">
	<?php endif; ?>
	
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $sf_request->getUriPrefix() . $sf_request->getRelativeUrlRoot() . url_for('feed'); ?>" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <?php 
        if (get_slot('page_type'))
            echo '<script>var page_type = "'.get_slot('page_type').'";window.pageType == "homepage" && window.location.search == "" && Modernizr.localstorage</script>';
    ?>

    <!-- Le styles -->
    <link href="<?php echo stylesheet_path('/styles/modern/modern.less'); ?>" rel="stylesheet/less">
    <script src="<?php echo javascript_path('/scripts/modern/less-1.1.5.min.js'); ?>"></script>
    <script src="<?php echo javascript_path('/scripts/modern/jquery-1.7.1.min.js'); ?>"></script>
	
    <script src="<?php echo javascript_path('/scripts/modern/bootstrap-2.0/bootstrap-dropdown.js'); ?>"></script>
    <script src="<?php echo javascript_path('/scripts/modern/modernizr.js'); ?>"></script>
    <script src="<?php echo javascript_path('/scripts/modern/main.js'); ?>"></script>
	
	<script src="<?php echo javascript_path('/scripts/modern/google-code-prettify/prettify.js'); ?>"></script>

    
    <?php include_stylesheets() ?>
	<?php include_javascripts() ?>
	
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

  </head>

  <body onload="prettyPrint();">

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
