<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
				<a class="brand"
					href="<?php echo substr(url_for('dashboard'), 0, -8); ?>"><?php echo sfConfig::get('app_details_name'); ?>
				</a>
			<div class="nav-collapse">
				<ul class="nav">

					<li><?php echo link_to(__('Dashboard'), 'dashboard'); ?>
					</li>

					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown"> <i class="icon-file icon-white"></i> <b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li><?php echo link_to('<i class="icon-file"></i> '.__('Last Posts'), 'posts'); ?>
							</li>
							<li><?php echo link_to('<i class="icon-plus"></i> '.__('Write new'), 'post_new'); ?>
							</li>
						</ul></li>

					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown"> <i class="icon-comment icon-white"></i> <b
							class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li><?php echo link_to('<i class="icon-comment"></i> '.__('Last Comments'), 'comment/index'); ?>
							</li>
							<li><?php echo link_to('<i class="icon-ban-circle"></i> '.__('Spam'), 'comment/spam'); ?>
							</li>
						</ul></li>

				</ul>

				<form action="<?php echo url_for('post_search'); ?>"
					class="navbar-search pull-right">
					<input class="search-query span3" type="text" name="query"
						placeholder="<?php echo __('Search'); ?>">
				</form>
				<form action="<?php echo url_for('post_search'); ?>"
					class="navbar-search pull-right">
					<input class="search-query span1" type="text" name="jump"
						placeholder="<?php echo __('Post-ID'); ?>">&nbsp;
				</form>
			</div>
		</div>
	</div>
</div>
