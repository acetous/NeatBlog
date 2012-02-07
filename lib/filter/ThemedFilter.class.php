<?php

class ThemedFilter extends sfFilter {

	public function execute($filterChain) {
		if ($this->isFirstCall()) {
			// set view classes
			$moduleDirs = array(
			sfConfig::get('sf_root_dir') . '/themes/default/' . $this->context->getConfiguration()->getApplication(),
			sfConfig::get('sf_root_dir') . '/themes/'.sfConfig::get('app_view_theme').'/' . $this->context->getConfiguration()->getApplication()
			);
			foreach ($moduleDirs as $moduleDir) {
				foreach(scandir($moduleDir) as $module) {
					if (substr($module, 0, 1) == '.' || !is_dir($moduleDir . '/' . $module))
					continue;
					sfConfig::set('mod_'.$module.'_view_class', 'Themed');
					sfConfig::set('mod_'.$module.'_partial_view_class', 'Themed');
				}
			}
		}

		$filterChain->execute();
	}

}