<?php

/**
 * Registration_check form base class.
 *
 * @method Registration_check getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRegistration_checkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'reg_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Registration'), 'add_empty' => true)),
      'hesh'       => new sfWidgetFormInputText(),
      'in_process' => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reg_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Registration'), 'required' => false)),
      'hesh'       => new sfValidatorString(array('max_length' => 32)),
      'in_process' => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Registration_check', 'column' => array('hesh')))
    );

    $this->widgetSchema->setNameFormat('registration_check[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Registration_check';
  }

}
