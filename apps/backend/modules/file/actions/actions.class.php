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
		$this->form = new BlogUploadForm();
		
		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		
		if ($this->form->isValid()) {
			$file = $this->form->getValue('file');
			$file->save($file->getPath().'/'.$file->getOriginalName());
		}
	}
}
