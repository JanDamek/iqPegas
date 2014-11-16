<?php

/**
 * Zpravy form base class.
 *
 * @method Zpravy getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseZpravyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'typ_uctu'   => new sfWidgetFormChoice(array('choices' => array('bu' => 'bu', 'sp' => 'sp'))),
      'mena'       => new sfWidgetFormChoice(array('choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'datum'      => new sfWidgetFormDate(),
      'popis'      => new sfWidgetFormInputText(),
      'text'       => new sfWidgetFormTextarea(),
      'precteno'   => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typ_uctu'   => new sfValidatorChoice(array('choices' => array(0 => 'bu', 1 => 'sp'), 'required' => false)),
      'mena'       => new sfValidatorChoice(array('choices' => array(0 => 'CZK', 1 => 'USD', 2 => 'EUR'), 'required' => false)),
      'datum'      => new sfValidatorDate(array('required' => false)),
      'popis'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'text'       => new sfValidatorString(array('required' => false)),
      'precteno'   => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('zpravy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Zpravy';
  }

}
