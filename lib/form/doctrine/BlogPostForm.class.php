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
		$this->useFields(array('title', 'content', 'micropost', 'published', 'markdown', 'published_at'));
		
		$this->widgetSchema['published_at'] = new sfWidgetFormInput();
		if ($this->getObject()->isNew()) {
			$this->widgetSchema['published_at']->setAttribute('value', 'now');
		} else {
			$this->widgetSchema['published_at']->setAttribute('value', $this->getObject()->getPublishedAt());
		}
		
		$this->widgetSchema->setLabel('title', 'Title');
		$this->widgetSchema->setLabel('content', 'Content');
		$this->widgetSchema->setHelp('content', 'HTML / <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a>.');
		$this->widgetSchema->setLabel('micropost', 'Display the post small.');
		$this->widgetSchema->setLabel('published', 'Publish the post.');
		$this->widgetSchema->setLabel('markdown', 'Use markdown to render the post. Pure HTML otherwise.');
		$this->widgetSchema->setLabel('published_at', 'Release Date');
		$this->widgetSchema->setHelp('published_at', 'YYYY-MM-DD hh:mm:ss');
		$this->validatorSchema['published_at']->setMessage('invalid', 'Unkown date format');
		
		$this->widgetSchema->setFormFormatterName('Bootstrap');
	}
}
