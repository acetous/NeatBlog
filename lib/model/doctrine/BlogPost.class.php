<?php

/**
 * BlogPost
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    blog
 * @subpackage model
 * @author     Sebastian Herbermann
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class BlogPost extends BaseBlogPost
{
	public function getPermaLink()
	{
		return sfContext::getInstance()->getRouting()->generate('post_permalink', $this, true);
	}
	
	public function getExcerpt()
	{
		$lines = explode("\n", $this->getContent());
		$excerpt = "";
		$excertPresent = false;
		foreach ($lines as $index => $line) {
			$line = trim($line);
			
			if (!$excertPresent) {
				// skip empty lines
				if (empty($line))
					continue;
				// skip headings
				// FIXME lines starting with '=' or '-' will be ignored
				if (in_array(substr($line, 0, 1), array('#', '=', '-')))
					continue;
				if (array_key_exists($index + 1, $lines) && in_array(substr($lines[$index + 1], 0, 1), array('=', '-')))
					continue;
				// skip images
				// TODO skip lines containing images?
				if (substr($line, 0, 2) == '![')
					continue;
				// skip lines containing HTML
				if (preg_match('/<(img|div|span)[^>]*>/i', $line) > 0)
					continue;
				
				$excerpt .= $line."\n";
				$excertPresent = true;
			} elseif (preg_match('/^\[[a-z]+\]: .*$/i', $line) > 0) {
				$excerpt .= $line."\n";
			}
		}
		return $excerpt;
	}
	
	public function setRead($visitor)
	{
		$visit = Doctrine::getTable('BlogPostVisitor')
		->createQuery('v')
		->where('v.token = ?', $visitor)
		->andWhere('v.post = ?', $this->getId())
		->limit(1)
		->execute()
		->getFirst();
		if ($visit) {
			$visit->setViews($visit->getViews() + 1);
			$visit->save();
		} else {
			$visit = new BlogPostVisitor();
			$visit->setToken($visitor);
			$visit->setPost($this->getId());
			$visit->save();
		}
	}
	
	public function isMicropost()
	{
		return $this->getMicropost();
	}
}
