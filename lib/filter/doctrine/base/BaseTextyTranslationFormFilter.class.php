<?php

/**
 * TextyTranslation filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTextyTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'text' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'text' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('texty_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TextyTranslation';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'text' => 'Text',
      'lang' => 'Text',
    );
  }
}
