<div class="topbar">
  <div class="fill">
    <div class="container">
      <a class="brand" href="<?php echo url_for('post/index'); ?>">acetous Blog</a>
      <ul class="nav">
        <li class="menu">
		  <a href="#" class="menu"><?php echo __('Posts'); ?></a>
		  <ul class="menu-dropdown">
		  	<li><?php echo link_to(__('Write new'), 'post_new'); ?></li>
		  </ul>
		</li>
      </ul>
	  <form action="" class="pull-right">
        <input class="mini" type="text" placeholder="Post-ID">
        <input class="" type="text" placeholder="Suche">
      </form>
    </div>
  </div>
</div>
