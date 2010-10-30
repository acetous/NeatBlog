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
			->orderBy('created_at desc')
			->execute();
	}
	
	public function executeShow(sfWebRequest $request)
	{
		$this->post = $this->getRoute()->getObject();
	}
	
	public function executePublish(sfWebRequest $request)
	{
		$post = $this->getRoute()->getObject();
		
		$post->setPublished( !$post->getPublished() );
		$post->save();
		
		if (substr($this->request->getReferer(), 0, 4) === 'http') {
			$this->redirect($this->request->getReferer());
		} else {
			$this->redirect('post');
		}
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->form = new BlogPostForm();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->form = new BlogPostForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}
	
	public function executeEdit(sfWebRequest $request)
	{
		$post = $this->getRoute()->getObject();
		$this->form = new BlogPostForm($post);
	}
	
	public function executeUpdate(sfWebRequest $request)
	{
		$post = $this->getRoute()->getObject();
		$this->form = new BlogPostForm($post);
		
		$this->processForm($request, $this->form);
		
		$this->setTemplate('edit');
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		$this->post = $this->getRoute()->getObject();
		$this->post->delete();
		$this->redirect('post');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$post = $form->save();

			$this->redirect('post_show', $post);
		}
	}
}
