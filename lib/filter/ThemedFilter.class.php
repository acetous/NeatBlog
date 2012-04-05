<?php

class ThemedFilter extends sfFilter {

	public function execute($filterChain) {
		set_error_handler(array('ThemedFilter', 'handleError'), error_reporting());
		
		if ($this->isFirstCall()) {
			// set view classes
			$themes = explode(',', sfConfig::get('app_view_theme'));
			$moduleDirs = array();
			foreach ($themes as $theme) {
				$theme = trim($theme);
				$moduleDirs[] = sfConfig::get('sf_root_dir') . '/themes/'.$theme.'/' . $this->context->getConfiguration()->getApplication(); 
			}
			foreach ($moduleDirs as $moduleDir) {
				foreach(scandir($moduleDir) as $module) {
					if (substr($module, 0, 1) == '.' || !is_dir($moduleDir . '/' . $module))
					continue;
					sfConfig::set('mod_'.$module.'_view_class', 'Themed');
					sfConfig::set('mod_'.$module.'_partial_view_class', 'Themed');
				}
			}
		}
		
		restore_error_handler();

		$filterChain->execute();
	}
	
	public static function handleError($errno, $errstr, $errfile, $errline) {
		throw new sfRenderException(sprintf("Could not initialize templates. Error (%d):\n %s\n in %s (line %d)", $errno, $errstr, $errfile, $errline));
	}
}