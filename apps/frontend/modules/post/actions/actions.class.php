<?php

/**
 * post actions.
 *
 * @package    blog
 * @subpackage post
 * @author     Sebastian Herbermann
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class postActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->posts = Doctrine::getTable('BlogPost')
			->createQuery('p')
			->where('published = ?', true)
			->orderBy('created_at desc')
			->execute();
	}
	
	public function executeShow(sfWebRequest $request)
	{
		$this->post = $this->getRoute()->getObject();
		
		if (!$this->post->getPublished()) {
			$this->forward404();
		}
		
		$this->post->setViews( $this->post->getViews() + 1 );
		$this->post->save();
	}
}
