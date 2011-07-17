<?php 

class Helpers
{
	public static function renderPartial($module, $template, $vars)
	{
		$class = sfConfig::get('mod_'.strtolower($module).'_partial_view_class', 'sf').'PartialView';
		$view = new $class(sfContext::getInstance(), $module, '_'.$template, '');
		$view->setPartialVars(true === sfConfig::get('sf_escaping_strategy') ? sfOutputEscaper::unescape($vars) : $vars);
		
		return $view->render();
	}
}