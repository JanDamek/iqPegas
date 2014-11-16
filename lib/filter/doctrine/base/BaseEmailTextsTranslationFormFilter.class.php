<?php

/**
 * EmailTextsTranslation filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEmailTextsTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'body'    => new sfWidgetFormFilterInput(),
      'subject' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'body'    => new sfValidatorPass(array('required' => false)),
      'subject' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email_texts_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailTextsTranslation';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'body'    => 'Text',
      'subject' => 'Text',
      'lang'    => 'Text',
    );
  }
}
