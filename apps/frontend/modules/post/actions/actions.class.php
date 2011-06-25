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
			->andWhere('micropost = ?', false)
			->orderBy('created_at desc')
			->execute();
		$this->microposts = Doctrine::getTable('BlogPost')
			->createQuery('p')
			->where('published = ?', true)
			->andWhere('micropost = ?', true)
			->orderBy('created_at desc')
			->execute();
			
		// check for new comments
		$this->postNewComments = array();
		foreach ($this->posts as $post) {
			$this->postNewComments[$post->getId()] = false;
		}
		foreach ($this->microposts as $post) {
			$this->postNewComments[$post->getId()] = false;
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
}
