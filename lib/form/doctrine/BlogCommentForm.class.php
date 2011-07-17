<?php

/**
 * BlogComment form.
 *
 * @package    blog
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BlogCommentForm extends BaseBlogCommentForm
{
	public function configure()	{
		$this->useFields(array('author', 'content', 'blog_post_id'));
		
		$this->widgetSchema['author']->setLabel('Your Name');
		$this->widgetSchema['content']->setLabel('Your Comment');
		
		$this->validatorSchema['author'] = new sfValidatorString(array(
			'trim' => true
		));
		$this->validatorSchema['content'] = new sfValidatorString(array(
					'trim' => true
		));
	}

	public function setPost(BlogPost $post) {
		 $this->setWidget("blog_post_id", new sfWidgetFormInputHidden(array(), array('value' => $post->getId())));
	}
}
