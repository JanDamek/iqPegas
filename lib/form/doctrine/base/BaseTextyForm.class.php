<?php

/**
 * Texty form base class.
 *
 * @method Texty getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTextyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'  => new sfWidgetFormInputHidden(),
      'typ' => new sfWidgetFormChoice(array('choices' => array('potvrzeni mailu' => 'potvrzeni mailu', 'neni hash' => 'neni hash', 'neni mail' => 'neni mail', 'hashin proccess' => 'hashin proccess', 'Zaslat novy hash na email' => 'Zaslat novy hash na email', 'NeniTextMailu' => 'NeniTextMailu', 'MailJizOdeslan' => 'MailJizOdeslan', 'Pro tento hash' => 'Pro tento hash', 'NastalaChyba' => 'NastalaChyba', 'LinkNaNovyMain' => 'LinkNaNovyMain', 'linkNovyMainLink' => 'linkNovyMainLink', 'Odeslani emailu' => 'Odeslani emailu', 'na Vami uvedeny email' => 'na Vami uvedeny email', 'novylink' => 'novylink', 'naMailBylOdeslanNovyHash' => 'naMailBylOdeslanNovyHash', 'potvrzeni_registrace_mailu' => 'potvrzeni_registrace_mailu'))),
    ));

    $this->setValidators(array(
      'id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typ' => new sfValidatorChoice(array('choices' => array(0 => 'potvrzeni mailu', 1 => 'neni hash', 2 => 'neni mail', 3 => 'hashin proccess', 4 => 'Zaslat novy hash na email', 5 => 'NeniTextMailu', 6 => 'MailJizOdeslan', 7 => 'Pro tento hash', 8 => 'NastalaChyba', 9 => 'LinkNaNovyMain', 10 => 'linkNovyMainLink', 11 => 'Odeslani emailu', 12 => 'na Vami uvedeny email', 13 => 'novylink', 14 => 'neni hash', 15 => 'naMailBylOdeslanNovyHash', 16 => 'potvrzeni_registrace_mailu'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Texty', 'column' => array('typ')))
    );

    $this->widgetSchema->setNameFormat('texty[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Texty';
  }

}
