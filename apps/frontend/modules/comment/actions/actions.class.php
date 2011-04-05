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

		if ($form->isValid())
		{
			$comment = $form->save();
		} else {
			$this->redirect('homepage');
		}
		$this->redirect('post_show', BlogPostTable::getInstance()->findOneById($form->getValue('blog_post_id')));
	}
}
