<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?php echo url_for('post/index'); ?>"><?php echo sfConfig::get('app_details_name'); ?></a>
      <ul class="nav">
	<?php if (isset($latestYear) && isset($earliestYear)) : ?>
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
	<?php endif; ?>
      </ul>
	  <form action="<?php echo url_for('post_search'); ?>" class="navbar-search pull-right">
        <input class="search-query" type="text" placeholder="Suche" name="query">
      </form>
    </div>
  </div>
</div>
