<?php

/**
 * Blokace form base class.
 *
 * @method Blokace getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBlokaceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'datum'       => new sfWidgetFormDate(),
      'castka'      => new sfWidgetFormInputText(),
      'karta'       => new sfWidgetFormChoice(array('choices' => array('PK: 408364XXXXXX2884' => 'PK: 408364XXXXXX2884', 'PK: 408359XXXXXX6465' => 'PK: 408359XXXXXX6465'))),
      'mena'        => new sfWidgetFormChoice(array('choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'obchod'      => new sfWidgetFormInputText(),
      'typ'         => new sfWidgetFormChoice(array('choices' => array('Platba kartou' => 'Platba kartou', 'Výběr z bankomatu' => 'Výběr z bankomatu'))),
      'misto'       => new sfWidgetFormInputText(),
      'realizovano' => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'datum'       => new sfValidatorDate(array('required' => false)),
      'castka'      => new sfValidatorPass(array('required' => false)),
      'karta'       => new sfValidatorChoice(array('choices' => array(0 => 'PK: 408364XXXXXX2884', 1 => 'PK: 408359XXXXXX6465'), 'required' => false)),
      'mena'        => new sfValidatorChoice(array('choices' => array(0 => 'CZK', 1 => 'USD', 2 => 'EUR'), 'required' => false)),
      'obchod'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'typ'         => new sfValidatorChoice(array('choices' => array(0 => 'Platba kartou', 1 => 'Výběr z bankomatu'), 'required' => false)),
      'misto'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'realizovano' => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('blokace[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Blokace';
  }

}
