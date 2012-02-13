<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?php echo substr(url_for('post/index'), 0, -8); ?>">acetous Blog</a>
      <ul class="nav">
      
        <li class="menu">
		  <a href="#" class="menu"><?php echo __('Posts'); ?></a>
		  <ul class="menu-dropdown">
		  	<li><?php echo link_to(__('Last Posts'), 'post/index'); ?></li>
		  	<li><?php echo link_to(__('Write new'), 'post_new'); ?></li>
		  </ul>
		</li>
		
        <li class="menu">
		  <a href="#" class="menu"><?php echo __('Comments'); ?></a>
		  <ul class="menu-dropdown">
		  	<li><?php echo link_to(__('Last Comments'), 'comment/index'); ?></li>
		  	<li><?php echo link_to(__('Spam'), 'comment/index'); ?></li>
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
