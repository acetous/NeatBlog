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
		$query = Doctrine::getTable('BlogPost')
			->createQuery('p')
			->where('published = ?', true)
			->orderBy('published_at desc');
		
		if ($request->hasParameter('year')) {
			$when = $request->getGetParameter('year');
			if (!preg_match('/^\d{4}$/', $when))
				return;
			
			$query->andWhere('published_at >= ?', $when.'-01-01');
			$query->andWhere('published_at <= ?', $when.'-12-31');
		} else {
			$query->limit(sfConfig::get('app_homepage_post_count', 20));
		}
		
		$query->andWhere('published_at <= now()');
		
		$this->posts = $query->execute();
	}
	
	public function executeShow(sfWebRequest $request)
	{
		$this->post = $this->getRoute()->getObject();
		
		$this->commentForm = new BlogCommentForm();
		$this->commentForm->setPost($this->post);
		
		if (!$this->post->getPublished() || $this->post->getDateTimeObject('published_at') > new DateTime()) {
			$this->forward404();
		}
		
		$this->post->setViews( $this->post->getViews() + 1 );
		$this->post->save(null, true);
	}
	
	public function executeCatchall(sfWebRequest $request)
	{
		$post = $this->getRoute()->getObject();
		if ($request->getUri() != $this->generateUrl('post_show', $post, true))
			$this->redirect($this->generateUrl('post_show', $post), 301);
		else
			$this->forward('post', 'show');
	}
	
	public function executePermalink(sfWebRequest $request)
	{
		$post = $this->getRoute()->getObject();
		$this->redirect($this->generateUrl('post_show', $post), 301);
	}
	
	public function executeSearch(sfWebRequest $request)
	{
		$query = $request->getGetParameter('query');
		
		if (isset($query) && !empty($query)) {
			$this->posts = Doctrine::getTable('BlogPost')->getForLuceneQuery($query);
		} else {
			$this->redirect('post/index');
		}
		
		$this->setTemplate('index');
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
}
