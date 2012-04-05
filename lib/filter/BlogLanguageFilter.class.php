<?php

class BlogLanguageFilter extends sfFilter
{
	public function execute($filterChain)
	{
		if ($this->isFirstCall())
		{
			// set culture
			$this->getContext()->getUser()->setCulture(
				sfConfig::get('app_view_language')
			);
		}
		
		$filterChain->execute();
	}
}