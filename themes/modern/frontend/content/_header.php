<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?php echo url_for('post/index'); ?>">acetous Blog</a>
      <ul class="nav">
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  	<?php echo __('Archive'); ?>
		  	<b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
		    <?php for($year = $latestYear; $year >= $earliestYear; $year--) : ?>
		        <li>
		            <a href="<?php echo url_for('homepage').'?year='.$year; ?>"><?php echo $year; ?></a>
		        </li>
		    <?php endfor; ?>
		  </ul>
		</li>
      </ul>
	  <form action="" class="navbar-search pull-right">
        <input class="search-query" type="text" placeholder="Suche">
      </form>
    </div>
  </div>
</div>