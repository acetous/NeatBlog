<?php

/**
 * BlogComment form base class.
 *
 * @method BlogComment getObject() Returns the current form's model object
 *
 * @package    blog
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBlogCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'author'       => new sfWidgetFormInputText(),
      'content'      => new sfWidgetFormTextarea(),
      'spam'         => new sfWidgetFormInputCheckbox(),
      'blog_post_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BlogPost'), 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'author'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'      => new sfValidatorString(),
      'spam'         => new sfValidatorBoolean(array('required' => false)),
      'blog_post_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BlogPost'))),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('blog_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogComment';
  }

}
