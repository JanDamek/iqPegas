<?php

/**
 * Pocatek form base class.
 *
 * @method Pocatek getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePocatekForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'typ_uctu'   => new sfWidgetFormChoice(array('choices' => array('bu' => 'bu', 'sp' => 'sp'))),
      'mena'       => new sfWidgetFormChoice(array('choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'stav'       => new sfWidgetFormInputText(),
      'urok'       => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typ_uctu'   => new sfValidatorChoice(array('choices' => array(0 => 'bu', 1 => 'sp'), 'required' => false)),
      'mena'       => new sfValidatorChoice(array('choices' => array(0 => 'CZK', 1 => 'USD', 2 => 'EUR'), 'required' => false)),
      'stav'       => new sfValidatorPass(array('required' => false)),
      'urok'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Pocatek', 'column' => array('typ_uctu', 'mena')))
    );

    $this->widgetSchema->setNameFormat('pocatek[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pocatek';
  }

}
