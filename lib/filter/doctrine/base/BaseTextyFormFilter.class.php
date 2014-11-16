<?php

/**
 * Texty filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTextyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typ' => new sfWidgetFormChoice(array('choices' => array('' => '', 'potvrzeni mailu' => 'potvrzeni mailu', 'neni hash' => 'neni hash', 'neni mail' => 'neni mail', 'hashin proccess' => 'hashin proccess', 'Zaslat novy hash na email' => 'Zaslat novy hash na email', 'NeniTextMailu' => 'NeniTextMailu', 'MailJizOdeslan' => 'MailJizOdeslan', 'Pro tento hash' => 'Pro tento hash', 'NastalaChyba' => 'NastalaChyba', 'LinkNaNovyMain' => 'LinkNaNovyMain', 'linkNovyMainLink' => 'linkNovyMainLink', 'Odeslani emailu' => 'Odeslani emailu', 'na Vami uvedeny email' => 'na Vami uvedeny email', 'novylink' => 'novylink', 'naMailBylOdeslanNovyHash' => 'naMailBylOdeslanNovyHash', 'potvrzeni_registrace_mailu' => 'potvrzeni_registrace_mailu'))),
    ));

    $this->setValidators(array(
      'typ' => new sfValidatorChoice(array('required' => false, 'choices' => array('potvrzeni mailu' => 'potvrzeni mailu', 'neni hash' => 'neni hash', 'neni mail' => 'neni mail', 'hashin proccess' => 'hashin proccess', 'Zaslat novy hash na email' => 'Zaslat novy hash na email', 'NeniTextMailu' => 'NeniTextMailu', 'MailJizOdeslan' => 'MailJizOdeslan', 'Pro tento hash' => 'Pro tento hash', 'NastalaChyba' => 'NastalaChyba', 'LinkNaNovyMain' => 'LinkNaNovyMain', 'linkNovyMainLink' => 'linkNovyMainLink', 'Odeslani emailu' => 'Odeslani emailu', 'na Vami uvedeny email' => 'na Vami uvedeny email', 'novylink' => 'novylink', 'naMailBylOdeslanNovyHash' => 'naMailBylOdeslanNovyHash', 'potvrzeni_registrace_mailu' => 'potvrzeni_registrace_mailu'))),
    ));

    $this->widgetSchema->setNameFormat('texty_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Texty';
  }

  public function getFields()
  {
    return array(
      'id'  => 'Number',
      'typ' => 'Enum',
    );
  }
}
