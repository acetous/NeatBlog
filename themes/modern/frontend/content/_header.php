<div class="topbar">
  <div class="fill">
    <div class="container">
      <a class="brand" href="<?php echo url_for('post/index'); ?>">acetous Blog</a>
      <ul class="nav">
        <li class="menu">
		  <a href="#" class="menu">Archiv</a>
		  <ul class="menu-dropdown">
		    <?php for($year = $latestYear; $year >= $earliestYear; $year--) : ?>
		        <li class="submenu">
		            <a href="#"><?php echo $year; ?></a>
		            <ul>
		                <?php for($month = ($year == $latestYear ? $latestMonth : 12); $month >= ($year == $earliestYear ? $earliestMonth : 1); $month--) : ?>
		                    <a href="<?php echo url_for('post/index') .'?archive='. $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT) ; ?>">
		                        <?php echo strftime("%B", mktime(0, 0, 0, $month)); ?>
		                    </a>
		                <?php endfor; ?>
		            </ul>
		        </li>
		    <?php endfor; ?>
		  </ul>
		</li>
      </ul>
	  <form action="" class="pull-right">
        <input class="input" type="text" placeholder="Suche">
      </form>
    </div>
  </div>
</div>
