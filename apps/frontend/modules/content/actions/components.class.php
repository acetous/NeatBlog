<?php 

class contentComponents extends sfComponents
{
	public function executeHeader()
	{
		$latestPost = Doctrine::getTable('BlogPost')
			->createQuery('p')
			->where('published = ?', true)
			->orderBy('created_at desc')
			->limit(1)
			->execute()
			->getFirst();
		$earliestPost = Doctrine::getTable('BlogPost')
			->createQuery('p')
			->where('published = ?', true)
			->orderBy('created_at asc')
			->limit(1)
			->execute()
			->getFirst();
		
		$this->latestMonth = strftime('%m', $latestPost->getDateTimeObject('created_at')->format('U'));
		$this->latestYear = strftime('%Y', $latestPost->getDateTimeObject('created_at')->format('U'));
		
		$this->earliestMonth = strftime('%m', $earliestPost->getDateTimeObject('created_at')->format('U'));
		$this->earliestYear = strftime('%Y', $earliestPost->getDateTimeObject('created_at')->format('U'));
	}
}