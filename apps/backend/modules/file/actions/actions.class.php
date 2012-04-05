<?php

/**
 * file actions.
 *
 * @package    blog
 * @subpackage file
 * @author     Sebastian Herbermann
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fileActions extends sfActions
{
	public function executeUpload(sfWebRequest $request)
	{
		$form = new BlogUploadForm();
		
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		
		if ($form->isValid()) {
			$file = $form->getValue('file');
			
			$path = sfConfig::get('sf_upload_dir').'/other';
			
			$postId = $request->getGetParameter('id');
			if (!empty($postId)) {
				$post = Doctrine::getTable('BlogPost')->findOneById($postId);
				$path = sfConfig::get('sf_upload_dir') . $post->getDateTimeObject('created_at')->format('/Y/m/') . $post->getId();
			}
			
			$file->save($path.'/'.$file->getOriginalName());
			
			$this->file = $path.'/'.$file->getOriginalName();
			
			$resizeSettings = sfConfig::get('app_uploads_resize');
			if (is_array($resizeSettings) && sizeof($resizeSettings) > 0) {
				$ir = new ImageResize($this->file);
				foreach ($resizeSettings as $resize) {
					$ir->resize($resize['width'], $resize['height'], $resize['zoom'], false);
				}
			}
		}
	}
	
	public function executeIndex(sfWebRequest $request)
	{
		$this->files = array();
		
		$path = sfConfig::get('sf_upload_dir').'/other';
		$postId = $request->getGetParameter('post');
		if (!empty($postId)) {
				$post = Doctrine::getTable('BlogPost')->findOneById($postId);
				$path = sfConfig::get('sf_upload_dir') . $post->getDateTimeObject('created_at')->format('/Y/m/') . $post->getId();
		}
		
		if (is_dir($path)) {		
			$dir = dir($path);
			while (false !== ($entry = $dir->read())) {
				if (!in_array($entry, array('.', '..'))) {
					$this->files[] = $entry;
					/*
					 * TODO: fix shown filetypes
					if (substr(mime_content_type($entry), 0, 6) == 'image/') {
						$this->files[] = $entry;
					}
					*/
				}
			}
			$dir->close();
			sort($this->files);
		}
		
		$this->globalFiles = array();
		if (is_dir(sfConfig::get('sf_upload_dir').'/global')) {
			$dir = dir(sfConfig::get('sf_upload_dir').'/global');
			while (false !== ($entry = $dir->read())) {
				if (!in_array($entry, array('.', '..'))) {
					$this->globalFiles[] = $entry;
				}
			}
			$dir->close();
		}
	}
}
