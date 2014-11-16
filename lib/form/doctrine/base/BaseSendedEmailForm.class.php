<?php

/**
 * SendedEmail form base class.
 *
 * @method SendedEmail getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSendedEmailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'reg_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Registration'), 'add_empty' => true)),
      'hesh'         => new sfWidgetFormInputText(),
      'mail_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmailTexts'), 'add_empty' => true)),
      'sended_od'    => new sfWidgetFormDate(),
      'send_success' => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reg_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Registration'), 'required' => false)),
      'hesh'         => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'mail_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmailTexts'), 'required' => false)),
      'sended_od'    => new sfValidatorDate(array('required' => false)),
      'send_success' => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('sended_email[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SendedEmail';
  }

}
