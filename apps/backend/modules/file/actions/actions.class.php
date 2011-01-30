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
		
		$dir = dir($path);
		while (false !== ($entry = $dir->read())) {
			if (!in_array($entry, array('.', '..'))) {
				if (substr(mime_content_type($file), 0, 6) == 'image/') {
					$this->files[] = $entry;
				}
			}
		}
		$dir->close();
	}
}
