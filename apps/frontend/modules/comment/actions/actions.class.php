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
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$form = new BlogCommentForm();
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		
		if ($cache = $this->getContext()->getViewCacheManager()) {
			$post = BlogPostTable::getInstance()->findOneById($form->getValue('blog_post_id'));
			$cache->remove(sprintf('post/catchall?id=%d&%s=*&sf_format=html', $post->getId(), $post->getSlug()));
		}

		if ($form->isValid())
		{
			$comment = $form->save();
			
			$this->checkForSpam($comment);
		} else {
			$this->redirect($request->getUri());
		}
		$this->redirect('post_show', BlogPostTable::getInstance()->findOneById($form->getValue('blog_post_id')));
	}
	
	public function checkForSpam($comment) {
		if ($comment->checkForSpam()) {
			$comment->setSpam(true);
			$comment->save();
		}
	}
}
