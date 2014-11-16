<?php

/**
 * NotallowedTranslation form base class.
 *
 * @method NotallowedTranslation getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotallowedTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'   => new sfWidgetFormInputHidden(),
      'word' => new sfWidgetFormInputText(),
      'lang' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'word' => new sfValidatorString(array('max_length' => 50)),
      'lang' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'NotallowedTranslation', 'column' => array('word')))
    );

    $this->widgetSchema->setNameFormat('notallowed_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotallowedTranslation';
  }

}
