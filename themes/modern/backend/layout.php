
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
	<?php include_metas() ?>
	
	<title>acetous Blog</title>
	
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
    <link href="<?php echo stylesheet_path('/../styles/modern/modern.backend.min.css'); ?>" rel="stylesheet">
    <script src="<?php echo javascript_path('/../scripts/modern/modern.backend.min.js'); ?>"></script>
    
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
	
	  <?php echo $sf_content; ?>

      <footer>
        <?php include_partial('content/footer'); ?>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
