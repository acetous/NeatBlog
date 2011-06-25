<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
	public function setup()
	{
		$this->enablePlugins('sfDoctrinePlugin');
		
		// include other vendors
		require_once dirname(__FILE__).'/../lib/vendor/markdown.php';
		
		// low-level config
		mb_internal_encoding('UTF-8');
	}
}
