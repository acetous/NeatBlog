<?php

class ThemedPartialView extends sfPartialView
{
    public function configure() {
		parent::configure();
		
		$themeDirFound = false;
	
		$baseDirectory = sfConfig::get('sf_root_dir') . "/themes";
		$themes = explode(',', sfConfig::get('app_view_theme'));
		
		foreach ($themes as $theme) {
			$theme = trim($theme);
			$themeDirectory = $baseDirectory . "/" . $theme;
			
			// set directory for template
			if (!$themeDirFound) {
				$relativeTemplateDirectory =
					"/" . $this->context->getConfiguration()->getApplication() .
					"/" . $this->moduleName;
				if (is_readable($themeDirectory . $relativeTemplateDirectory . "/" . $this->getTemplate())) {
		    		$this->setDirectory($themeDirectory . $relativeTemplateDirectory);
					 $themeDirFound = true;
				}
			}
		}
		
		if (!$themeDirFound)
			throw new sfRenderException(sprintf('The template "%s" does not exist or in unreadable.', $this->getTemplate()));
    }
}