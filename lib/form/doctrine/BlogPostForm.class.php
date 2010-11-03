<?php

/**
 * BlogPost form.
 *
 * @package    blog
 * @subpackage form
 * @author     Sebastian Herbermann
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BlogPostForm extends BaseBlogPostForm
{
	public function configure()
	{
		$this->useFields(array('title', 'content', 'published'));
		
		$this->widgetSchema->setLabel('title', 'The title for your post\'s link:');
		$this->widgetSchema->setLabel('content', 'Your content:');
		$this->widgetSchema->setHelp('content', '<a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown Syntax</a>');
		$this->widgetSchema->setLabel('published', 'Make it public?');
	}
}
