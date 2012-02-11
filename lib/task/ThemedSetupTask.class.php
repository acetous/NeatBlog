<?php

class ThemedSetupTask extends sfBaseTask
{
	private $themesDirectory, $stylesDirectory, $scriptsDirectory, $assetsDirectory;

	protected function configure()
	{
		$this->addArgument('theme', sfCommandArgument::OPTIONAL, 'The name of the theme');

		$this->namespace = 'themed';
		$this->name = 'setup';
		$this->briefDescription = 'Setup a theme.';

		$this->detailedDescription = <<<EOF
The [themed:setup|INFO] task can be used to setup a specific theme:

By default you can setup all present themes:

  [./symfony themed:setup|INFO]

If you only want to setup a specific theme, e.g. [mytheme|COMMENT], name it:

  [./symfony themed:setup mytheme|INFO]
EOF;

		$this->themesDirectory = sfConfig::get('sf_root_dir') . '/themes';
		$this->stylesDirectory = sfConfig::get('sf_web_dir') . '/styles';
		$this->scriptsDirectory = sfConfig::get('sf_web_dir') . '/scripts';
		$this->assetsDirectory = sfConfig::get('sf_web_dir') . '/assets';
	}

	protected function execute($arguments = array(), $options = array())
	{
		if (!is_writable($this->stylesDirectory))
		throw new sfException(sprintf('CSS-Directory "%s" is not writeable.', $this->stylesDirectory));

		if (empty($arguments['theme'])) {
			$this->logSection('themed', 'Starting setup for all themes');
			foreach (scandir($this->themesDirectory) as $theme) {
				if (substr($theme, 0, 1) == '.' || !is_dir($this->themesDirectory . '/' . $theme))
				continue;
				$this->setupTheme($theme);
			}
		} else {
			$this->setupTheme($arguments['theme']);
		}
	}

	private function setupTheme($theme) {
		$this->logSection($theme, sprintf('Starting setup for theme "%s"', $theme));
		$this->preCheck($theme);
		$this->logSection($theme, sprintf("\tCopy styles..."));
		$this->copyStyles($theme);
		$this->logSection($theme, sprintf("\tCopy scripts..."));
		$this->copyScripts($theme);
		$this->logSection($theme, sprintf("\tCopy assets..."));
		$this->copyAssets($theme);
	}

	private function preCheck($theme) {
		if (!is_readable($this->themesDirectory . '/' . $theme))
			throw new sfException(sprintf('Theme "%s" cannot be read.', $theme));
		
		$dirs = array(
			$this->themesDirectory . '/' . $theme . '/styles',
			$this->themesDirectory . '/' . $theme . '/scripts',
			$this->themesDirectory . '/' . $theme . '/assets'
		);
		foreach ($dirs as $dir) {
			if (!is_dir($dir))
				@mkdir($dir, true);
			if (!is_readable($dir))
				throw new sfException(sprintf('Theme "%s" seems broken. Cannot read %s', $theme, $dir));
		}
	}

	private function copyStyles($theme) {
		Helpers::rcopy($this->themesDirectory . '/' . $theme . '/styles', $this->stylesDirectory . '/' . $theme);
	}
	
	private function copyScripts($theme) {
		Helpers::rcopy($this->themesDirectory . '/' . $theme . '/scripts', $this->scriptsDirectory . '/' . $theme);
	}
	
	private function copyAssets($theme) {
		Helpers::rcopy($this->themesDirectory . '/' . $theme . '/assets', $this->assetsDirectory . '/' . $theme);
	}
}
