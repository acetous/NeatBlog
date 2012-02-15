<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
	static protected $zendLoaded = false;
	
	public function setup()
	{
		$this->enablePlugins('sfDoctrinePlugin');
		
		// include other vendors
		self::registerOtherVendors();
		
		// low-level config
		mb_internal_encoding('UTF-8');
	}
	
	static public function registerZend() {
		if (self::$zendLoaded)
			return;
		
		set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
		require_once sfConfig::get('sf_lib_dir').'/vendor/Zend/Loader/Autoloader.php';
		Zend_Loader_Autoloader::getInstance();
		self::$zendLoaded = true;
	}
	
	static public function registerOtherVendors() {
		require_once sfConfig::get('sf_lib_dir').'/vendor/AkismetClient.class.php';
		require_once sfConfig::get('sf_lib_dir').'/vendor/markdown.php';
	}
}
