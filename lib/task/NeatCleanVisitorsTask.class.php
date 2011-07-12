<?php

class NeatCleanVisitorsTask extends sfBaseTask
{    
    protected function configure()
    {
    	$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environement', 'prod');
		$this->addOption('months', null, sfCommandOption::PARAMETER_OPTIONAL, 'The duration in months.');
		$this->addOption('weeks', null, sfCommandOption::PARAMETER_OPTIONAL, 'The duration in weeks.');
		$this->addOption('days', null, sfCommandOption::PARAMETER_OPTIONAL, 'The duration in days.');
		
		$this->namespace = 'neat';
		$this->name = 'clean-visitors';
		$this->briefDescription = 'Clean old visitor entries from the database.';
		
		$this->detailedDescription = <<<EOF
The [neat:clean-visitors|INFO] task can be used to clean old visitors from the database.

You have to pass a duration. All visitor entries older than the given duration will be deleted.

  [./symfony neat:clean-visitors --months=1|INFO]
  [./symfony neat:clean-visitors --weeks=4|INFO]
  [./symfony neat:clean-visitors --days=30|INFO]
		
If more than one option is given, only one of them will be applied. The priority is the same as listed above.
		
Supplying zero as any interval will remove all visitors:
		
  [./symfony neat:clean-visitors --days=0|INFO]
EOF;
		
		$this->themesDirectory = sfConfig::get('sf_root_dir') . '/themes';
		$this->cssDirectory = sfConfig::get('sf_web_dir') . '/css';
    }
    
    protected function execute($arguments = array(), $options = array())
    {
    	$interval = null;
    	$unit = null;
    	if (isset($options['months'])) {
    		$interval = $options['months'];
    		$unit = 'M';
    	} elseif (isset($options['weeks'])) {
    		$interval = $options['weeks'];
    		$unit = 'W';
    	} elseif (isset($options['days'])) {
    		$interval = $options['days'];
    		$unit = 'D';
    	}
    	if (is_null($interval) || intval($interval) != (int) $interval) {
    		$this->logSection('error', 'No correct interval given.');
    		return false;
    	}
    	
    	$databaseManager = new sfDatabaseManager($this->configuration);
    	$count = Doctrine_Core::getTable('BlogPostVisitor')->cleanup(sprintf('P%d%s', $interval, $unit));
    	$this->logSection('doctrine', sprintf('Removed %d visitors', $count));
    }
}
