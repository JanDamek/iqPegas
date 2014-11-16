<?php

/**
 * Sms form base class.
 *
 * @method Sms getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSmsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'kdo'        => new sfWidgetFormInputText(),
      'kod'        => new sfWidgetFormInputText(),
      'obsah'      => new sfWidgetFormTextarea(),
      'odeslano'   => new sfWidgetFormInputCheckbox(),
      'overeno'    => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'kdo'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'kod'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'obsah'      => new sfValidatorString(array('max_length' => 1500, 'required' => false)),
      'odeslano'   => new sfValidatorBoolean(array('required' => false)),
      'overeno'    => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('sms[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sms';
  }

}
