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
		$this->comments = Doctrine::getTable('BlogComment')
			->createQuery('c')
			->orderBy('created_at desc')
			->where('c.spam = ?', false)
			->limit(50)
			->execute();
	}
	
	public function executeSpam(sfWebRequest $request)
	{
		$this->comments = Doctrine::getTable('BlogComment')
			->createQuery('c')
			->orderBy('created_at desc')
			->where('c.spam = ?', true)
			->execute();
	}
	
	public function executeDeleteSpam(sfWebRequest $request)
	{
		$this->comments = Doctrine::getTable('BlogComment')
			->createQuery('c')
			->delete()
			->where('c.spam = ?', true)
			->execute();
		
		$this->redirect('comment/spam');
	}
	
	public function executeToggleSpam(sfWebRequest $request)
	{
		$comment = $this->getRoute()->getObject();
		
// 		if ($comment->getSpam()) {
// 			$comment->submitHam();
// 		} else {
// 			$comment->submitSpam();
// 		}
		
		$comment->setSpam(!$comment->getSpam());
		$comment->save();
		
		if ($referer = $request->getReferer())
			$this->redirect($referer);
		else
			$this->redirect('comment/spam');
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		$this->comment = $this->getRoute()->getObject();
		$this->comment->delete();
		if ($referer = $request->getReferer())
			$this->redirect($referer);
		else
			$this->redirect('comments');
	}
}
