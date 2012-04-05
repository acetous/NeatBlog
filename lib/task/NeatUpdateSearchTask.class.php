<?php 

class NeatUpdateSearchTask extends sfBaseTask
{
	protected function configure()
	{
		$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environement', 'prod');

		$this->namespace = 'neat';
		$this->name = 'update-search';
		$this->briefDescription = 'Update the search index.';

		$this->detailedDescription = <<<EOF
The [neat:update-search|INFO] task can be used to update the search index if posts are missing.
EOF;
	}

	protected function execute($arguments = array(), $options = array())
	{
		$added = 0;
		
		sfToolkit::clearGlob(sfConfig::get('sf_data_dir').'/post.'.$options['env'].'.index');
		sfFilesystem::remove(sfConfig::get('sf_data_dir').'/post.'.$options['env'].'.index');
		 
		$databaseManager = new sfDatabaseManager($this->configuration);
		$posts = Doctrine_Core::getTable('BlogPost')
			->createQuery('p')
			->where('p.published = ?', true)
			->execute();
		$index = BlogPostTable::getLuceneIndex();
		 
		foreach ($posts as $post) {
			$post->updateLuceneIndex();
				
			$added++;
			$this->logSection('doctrine', sprintf('ADDED: [%d] %s.', $post->getId(), $post->getTitle()));
		}
		 
		$index->optimize();
		 
		$this->logSection('doctrine', sprintf('Added %d posts to search index.', $added));
	}
}