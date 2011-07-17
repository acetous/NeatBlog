<?php

class postComponents extends sfComponents
{
	public function executePreview()
	{
		$visitor = $this->getUser()->getVisitorID();
		$this->hasNewComments = $this->visitorNewCommentsForPost($visitor, $this->post);	
	}
	
	public function executeMicropost()
	{
		$visitor = $this->getUser()->getVisitorID();
		$this->hasNewComments = $this->visitorNewCommentsForPost($visitor, $this->post);
	}

	private function visitorNewCommentsForPost($visitor, $post) {
		$lastComment = Doctrine::getTable('BlogComment')
		->createQuery('c')
		->where('blog_post_id = ?', $post->getId())
		->orderBy('c.created_at desc')
		->limit(1)
		->execute()
		->getFirst();
		if (!$lastComment) {
			return false;
		}

		// data present for visitor and post
		$visit = Doctrine::getTable('BlogPostVisitor')
		->createQuery('v')
		->where('v.token = ?', $visitor)
		->andWhere('v.post = ?', $post->getId())
		->limit(1)
		->execute()
		->getFirst();
		if ($visit) {
			return ($visit->getDateTimeObject('updated_at') < $lastComment->getDateTimeObject('created_at'));
		} else {
			$visit = Doctrine::getTable('BlogPostVisitor')
			->createQuery('v')
			->where('v.token = ?', $visitor)
			->andWhere('v.post = ?', 0)
			->limit(1)
			->execute()
			->getFirst();
			if (!$visit)
			return false;
			return ($visit->getDateTimeObject('created_at') < $lastComment->getDateTimeObject('created_at'));
		}
		return false;
	}
}