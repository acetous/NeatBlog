<?php

class BlogUploadForm extends BaseForm
{
	public function setup()
	{
		$this->setWidgets(array(
			'file'	=> new sfWidgetFormInputFile()
		));

		$this->setValidators(array(
			'file'	=> new sfValidatorFile(array(
				'path'			=> sfConfig::get('sf_upload_dir').'/other',
				'mime_types'	=> 'web_images'
			))
		));

		$this->validatorSchema->setPostValidator(
		new sfValidatorDoctrineUnique(array('model' => 'BlogPost', 'column' => array('slug')))
		);

		$this->widgetSchema->setNameFormat('blog_upload[%s]');

		$this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
		
		$this->disableCSRFProtection();

		parent::setup();
	}
}