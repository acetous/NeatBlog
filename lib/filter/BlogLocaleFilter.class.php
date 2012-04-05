<?php

class BlogLocaleFilter extends sfFilter
{
	public function execute($filterChain)
	{
		if ($this->isFirstCall())
		{			
			// set locale for PHP
			setlocale(LC_ALL, sfConfig::get('app_view_locale', null));
		}
		
		$filterChain->execute();
	}
}