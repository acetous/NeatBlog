<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
	<?php include_metas() ?>
	
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	
	<title><?php echo sfConfig::get('app_details_name'); ?></title>
	
	<link rel="shortcut icon" href="/favicon.ico" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <?php 
        if (get_slot('page_type'))
            echo '<script>var page_type = "'.get_slot('page_type').'";window.pageType == "homepage" && window.location.search == "" && Modernizr.localstorage</script>';
    ?>

    <!-- Le styles -->
    <link href="<?php echo stylesheet_path('/../styles/modern/modern.backend.min.css'); ?>?v=2" rel="stylesheet">
    <script src="<?php echo javascript_path('/../scripts/modern/modern.backend.min.js'); ?>?v=2"></script>
    
	<?php 
		if (get_slot('page_type'))
			echo '<script>var page_type = "'.get_slot('page_type').'";</script>';
	?>

    <?php include_stylesheets() ?>
	<?php include_javascripts() ?>
	
  </head>

  <body onload="prettyPrint();">

    <?php include_partial('content/header'); ?>

    <div class="container">
    
    
      <?php if ($sf_user->hasFlash('alert')) echo $sf_data->getRaw('sf_user')->getFlash('alert') ?>
	
	  <?php echo $sf_content; ?>

      <footer>
        <?php include_partial('content/footer'); ?>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
