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
		$this->useFields(array('title', 'content', 'micropost', 'published', 'markdown'));
		
		$this->widgetSchema->setLabel('title', 'Title');
		$this->widgetSchema->setLabel('content', 'Content');
		$this->widgetSchema->setHelp('content', 'You can use HTML and <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown Syntax</a>.');
		$this->widgetSchema->setLabel('micropost', 'Display the post small.');
		$this->widgetSchema->setLabel('published', 'Publish the post.');
		$this->widgetSchema->setLabel('markdown', 'Use markdown to render the post. Pure HTML otherwise.');
		
		$this->widgetSchema->setFormFormatterName('Bootstrap');
	}
}
