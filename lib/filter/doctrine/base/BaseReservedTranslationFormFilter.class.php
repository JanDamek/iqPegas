<?php

/**
 * ReservedTranslation filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReservedTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'word' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'word' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reserved_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReservedTranslation';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'word' => 'Text',
      'lang' => 'Text',
    );
  }
}
