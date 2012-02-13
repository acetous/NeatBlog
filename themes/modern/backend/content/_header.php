<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?php echo substr(url_for('post/index'), 0, -8); ?>">acetous Blog</a>
      <ul class="nav">
      
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  	<i class="icon-file icon-white"></i> <b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
		  	<li><?php echo link_to('<i class="icon-file"></i> '.__('Last Posts'), 'post/index'); ?></li>
		  	<li><?php echo link_to('<i class="icon-plus"></i> '.__('Write new'), 'post_new'); ?></li>
		  </ul>
		</li>
		
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  	<i class="icon-comment icon-white"></i> <b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
		  	<li><?php echo link_to('<i class="icon-comment"></i> '.__('Last Comments'), 'comment/index'); ?></li>
		  	<li><?php echo link_to('<i class="icon-ban-circle"></i> '.__('Spam'), 'comment/index'); ?></li>
		  </ul>
		</li>
		
      </ul>
	  <form action="" class="navbar-search pull-right">
        <input class="search-query span2" type="text" placeholder="<?php echo __('Post-ID / URL'); ?>">
        <input class="search-query span2" type="text" placeholder="<?php echo __('Search'); ?>">
      </form>
    </div>
  </div>
</div>
