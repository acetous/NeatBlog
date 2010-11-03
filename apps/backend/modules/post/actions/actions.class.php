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

		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		if ($this->form->isValid())
		{
			$post = $this->form->save();
			
			// move images
			$path = $post->getDateTimeObject('created_at')->format('/Y/m/') . $post->getId() . '/';
			
			$matches = array();
			preg_match_all('$/uploads(?P<path>/other/(?P<name>[^.]+\.(jpg|jpeg|png|gif)))$i', $post->getContent(), $matches, PREG_SET_ORDER);
			if (stripos($post->getContent(), '/uploads/other/') !== false) {
				foreach ($matches as $match) {
					$oldImage = sfConfig::get('sf_upload_dir') . $match['path'];
					$newImage = sfConfig::get('sf_upload_dir') . $path . $match['name'];
					
					if (is_file($oldImage)) {
						if (!is_dir(dirname($newImage))) {
							if (!mkdir(dirname($newImage), 0775, true)) throw new Exception('Could not create dir for '.$newImage);
						}
						if (!rename($oldImage, $newImage)) throw new Exception('Could not move '.$oldImage.' to '.$newImage);
						
						$post->setContent( str_ireplace($match['path'], $path.$match['name'], $post->getContent()) );
					}
				}
				$post->save();
			}
			$this->redirect('post_show', $post);
		}

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
		
		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		if ($this->form->isValid())
		{
			$post = $this->form->save();

			$this->redirect('post_show', $post);
		}
		
		$this->setTemplate('edit');
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		$this->post = $this->getRoute()->getObject();
		$this->post->delete();
		$this->redirect('post');
	}
}
