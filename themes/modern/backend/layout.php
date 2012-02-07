
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
    <link href="<?php echo stylesheet_path('/../styles/modern/main.less'); ?>" rel="stylesheet/less">
    <script src="<?php echo javascript_path('/../scripts/modern/less-1.1.5.min.js'); ?>"></script>
    <script src="<?php echo javascript_path('/../scripts/modern/jquery-1.7.1.min.js'); ?>"></script>
	
    <script src="<?php echo javascript_path('/../scripts/modern/bootstrap-dropdown.js'); ?>"></script>
    <script src="<?php echo javascript_path('/../scripts/modern/bootstrap-tabs.js'); ?>"></script>
    <script src="<?php echo javascript_path('/../scripts/modern/modernizr.js'); ?>"></script>
    <script src="<?php echo javascript_path('/../scripts/modern/main.js'); ?>"></script>
    
    <link href="<?php echo stylesheet_path('/../styles/modern/prettify.css'); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo javascript_path('/../scripts/modern/google-code-prettify/prettify.js'); ?>"></script>

    
    <?php include_stylesheets() ?>
	<?php include_javascripts() ?>
	
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
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
