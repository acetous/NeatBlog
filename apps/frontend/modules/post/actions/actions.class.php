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
	private $visitor = null;
	
	public function executeIndex(sfWebRequest $request)
	{
		$this->postPager = new sfDoctrinePager('BlogPost', 7);
		$this->postPager->setQuery(
			Doctrine::getTable('BlogPost')
				->createQuery('p')
				->where('published = ?', true)
				->andWhere('micropost = ?', false)
				->orderBy('created_at desc')
		);
		$this->postPager->setPage($this->getRequestParameter('p_page', 1));
		$this->postPager->init();
		$this->posts = $this->postPager->getResults();
			
		$this->micropostPager = new sfDoctrinePager('BlogPost', 10);
		$this->micropostPager->setQuery(
			Doctrine::getTable('BlogPost')
				->createQuery('p')
				->where('published = ?', true)
				->andWhere('micropost = ?', true)
				->orderBy('created_at desc')
		);
		$this->micropostPager->setPage($this->getRequestParameter('mp_page', 1));
		$this->micropostPager->init();
		$this->microposts = $this->micropostPager->getResults();
		
		
		// check for new comments
		$visitor = $this->getVisitor($request);
		$this->updateVisitorData($visitor, 0);
		
		$this->postNewComments = array();
		foreach ($this->posts as $post) {
			$this->postNewComments[$post->getId()] = $this->visitorNewCommentsForPost($visitor, $post);
		}
		foreach ($this->microposts as $post) {
			$this->postNewComments[$post->getId()] = $this->visitorNewCommentsForPost($visitor, $post);
		}
	}
	
	public function executeShow(sfWebRequest $request)
	{
		$this->post = $this->getRoute()->getObject();
		
		$this->commentForm = new BlogCommentForm();
		$this->commentForm->setPost($this->post);
		
		if (!$this->post->getPublished()) {
			$this->forward404();
		}
		
		$this->post->setViews( $this->post->getViews() + 1 );
		$this->post->save();
		
		// update visitor data
		$this->updateVisitorData($this->getVisitor($request), $this->post->getId());
	}
	
	public function executePermalink(sfWebRequest $request)
	{
		$post = $this->getRoute()->getObject();
		$this->redirect($this->generateUrl('post_show', $post), 301);
	}
	
	public function executeFeed(sfWebRequest $request)
	{
		$this->getResponse()->setHttpHeader('Content-Type', 'application/rss+xml');
		
		$this->posts = Doctrine::getTable('BlogPost')
			->createQuery('p')
			->where('published = ?', true)
			->orderBy('created_at desc')
			->execute();
	}
	
	public function executeCommentsread(sfWebRequest $request)
	{
		$visitor = $this->getVisitor($request);
		Doctrine::getTable('BlogPostVisitor')
			->createQuery('v')
			->delete()
			->where('v.token = ?', $visitor)
			->execute();
		$this->redirect('homepage');
	}
	
	private function getVisitor($request)
	{
		if (is_null($this->visitor)) {
			$this->visitor = $request->getCookie('visitor');
			if (empty($this->visitor)) {
				$this->visitor = md5(uniqid(mt_rand(), true));
			}
			$this->getResponse()->setCookie('visitor', $this->visitor, time()+60*60*24*30);
		}
		return $this->visitor;
	}
	
	private function updateVisitorData($visitor, $post)
	{
		$visit = Doctrine::getTable('BlogPostVisitor')
			->createQuery('v')
			->where('v.token = ?', $visitor)
			->andWhere('v.post = ?', $post)
			->limit(1)
			->execute()
			->getFirst();
		if ($visit) {
			$visit->setViews($visit->getViews() + 1);
			$visit->save();
		} else {
			$visit = new BlogPostVisitor();
			$visit->setToken($visitor);
			$visit->setPost($post);
			$visit->save();
		}
	}
	
	private function visitorNewCommentsForPost($visitor, $post) {
		$lastComment = Doctrine::getTable('BlogComment')
			->createQuery('c')
			->where('blog_post_id = ?', $post->getId())
			->orderBy('c.created_at desc')
			->limit(1)
			->execute()
			->getFirst();
		if (!$lastComment) {
			return false;
		}
		
		// data present for visitor and post
		$visit = Doctrine::getTable('BlogPostVisitor')
			->createQuery('v')
			->where('v.token = ?', $visitor)
			->andWhere('v.post = ?', $post->getId())
			->limit(1)
			->execute()
			->getFirst();
		if ($visit) {
			return ($visit->getDateTimeObject('updated_at') < $lastComment->getDateTimeObject('created_at'));
		} else {
			$visit = Doctrine::getTable('BlogPostVisitor')
				->createQuery('v')
				->where('v.token = ?', $visitor)
				->andWhere('v.post = ?', 0)
				->limit(1)
				->execute()
				->getFirst();
			if (!$visit)
				return false;
			return ($visit->getDateTimeObject('created_at') < $lastComment->getDateTimeObject('created_at'));
		}
		return false;
	}
}
