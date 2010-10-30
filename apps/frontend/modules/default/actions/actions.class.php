<?php

/**
 * default actions.
 *
 * @package    blog
 * @subpackage default
 * @author     Sebastian Herbermann
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
	public function executeError404(sfWebRequest $request) {}
	public function executeLogin(sfWebRequest $request) {}
	public function executeSecure(sfWebRequest $request) {}
	public function executeDisabled(sfWebRequest $request) {}	
}
