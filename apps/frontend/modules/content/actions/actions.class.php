<?php

/**
 * content actions.
 *
 * @package    blog
 * @subpackage content
 * @author     Sebastian Herbermann
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentActions extends sfActions
{
	public function executeImprint(sfWebRequest $request)
	{
		$this->content = sfConfig::get('app_details_imprint');
	}
}
