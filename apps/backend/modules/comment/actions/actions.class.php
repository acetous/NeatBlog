<?php

/**
 * comment actions.
 *
 * @package    blog
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->commentPager = new sfDoctrinePager('BlogComment', 30);
		$this->commentPager->setQuery(
			Doctrine::getTable('BlogComment')
				->createQuery('c')
				->orderBy('created_at desc')
		);
		$this->commentPager->setPage($this->getRequestParameter('page', 1));
		$this->commentPager->init();
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		$this->comment = $this->getRoute()->getObject();
		$this->comment->delete();
		$this->redirect('comments');
	}
}
