<?php

/**
 * Pohyby form base class.
 *
 * @method Pohyby getObject() Returns the current form's model object
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePohybyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'typ_uctu'                    => new sfWidgetFormChoice(array('choices' => array('bu' => 'bu', 'sp' => 'sp'))),
      'mena'                        => new sfWidgetFormChoice(array('choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'typ'                         => new sfWidgetFormChoice(array('choices' => array('Převod' => 'Převod', 'Příchozí platba' => 'Příchozí platba', 'Úrok' => 'Úrok', 'Daň' => 'Daň', 'Platba kartou' => 'Platba kartou', 'Výběr z bankomatu' => 'Výběr z bankomatu', 'Kompenzace' => 'Kompenzace', 'Trvalý převod' => 'Trvalý převod', 'Správa účtu' => 'Správa účtu', 'Poplatek za vedení karty' => 'Poplatek za vedení karty', 'Storno převodu' => 'Storno převodu'))),
      'karta'                       => new sfWidgetFormChoice(array('choices' => array('PK: 408364XXXXXX2884' => 'PK: 408364XXXXXX2884', 'PK: 408359XXXXXX6465' => 'PK: 408359XXXXXX6465'))),
      'kod_transakce'               => new sfWidgetFormInputText(),
      'datum'                       => new sfWidgetFormDate(),
      'cas'                         => new sfWidgetFormTime(),
      'z_uctu'                      => new sfWidgetFormInputText(),
      'v_mene'                      => new sfWidgetFormChoice(array('choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'na_ucet'                     => new sfWidgetFormInputText(),
      'kod_banky'                   => new sfWidgetFormInputText(),
      'castku'                      => new sfWidgetFormInputText(),
      'meny'                        => new sfWidgetFormChoice(array('choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'kurz'                        => new sfWidgetFormInputText(),
      'poplatek'                    => new sfWidgetFormInputText(),
      'zprava'                      => new sfWidgetFormInputText(),
      'variabilni_symbol'           => new sfWidgetFormInputText(),
      'konstantni_symbol'           => new sfWidgetFormInputText(),
      'specificky_symbol'           => new sfWidgetFormInputText(),
      'prevest_dne'                 => new sfWidgetFormDate(),
      'ukonceni_platnosti'          => new sfWidgetFormDate(),
      'zprava_pro_prijemce'         => new sfWidgetFormInputText(),
      'zprava_pro_mne'              => new sfWidgetFormInputText(),
      'umoznit_castecnou_realizaci' => new sfWidgetFormInputCheckbox(),
      'realizovano'                 => new sfWidgetFormInputCheckbox(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typ_uctu'                    => new sfValidatorChoice(array('choices' => array(0 => 'bu', 1 => 'sp'), 'required' => false)),
      'mena'                        => new sfValidatorChoice(array('choices' => array(0 => 'CZK', 1 => 'USD', 2 => 'EUR'), 'required' => false)),
      'typ'                         => new sfValidatorChoice(array('choices' => array(0 => 'Převod', 1 => 'Příchozí platba', 2 => 'Úrok', 3 => 'Daň', 4 => 'Platba kartou', 5 => 'Výběr z bankomatu', 6 => 'Kompenzace', 7 => 'Trvalý převod', 8 => 'Správa účtu', 9 => 'Poplatek za vedení karty', 10 => 'Storno převodu'), 'required' => false)),
      'karta'                       => new sfValidatorChoice(array('choices' => array(0 => 'PK: 408364XXXXXX2884', 1 => 'PK: 408359XXXXXX6465'), 'required' => false)),
      'kod_transakce'               => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'datum'                       => new sfValidatorDate(array('required' => false)),
      'cas'                         => new sfValidatorTime(array('required' => false)),
      'z_uctu'                      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'v_mene'                      => new sfValidatorChoice(array('choices' => array(0 => 'CZK', 1 => 'USD', 2 => 'EUR'), 'required' => false)),
      'na_ucet'                     => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'kod_banky'                   => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'castku'                      => new sfValidatorPass(array('required' => false)),
      'meny'                        => new sfValidatorChoice(array('choices' => array(0 => 'CZK', 1 => 'USD', 2 => 'EUR'), 'required' => false)),
      'kurz'                        => new sfValidatorPass(array('required' => false)),
      'poplatek'                    => new sfValidatorPass(array('required' => false)),
      'zprava'                      => new sfValidatorPass(array('required' => false)),
      'variabilni_symbol'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'konstantni_symbol'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'specificky_symbol'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'prevest_dne'                 => new sfValidatorDate(array('required' => false)),
      'ukonceni_platnosti'          => new sfValidatorDate(array('required' => false)),
      'zprava_pro_prijemce'         => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'zprava_pro_mne'              => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'umoznit_castecnou_realizaci' => new sfValidatorBoolean(array('required' => false)),
      'realizovano'                 => new sfValidatorBoolean(array('required' => false)),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('pohyby[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pohyby';
  }

}
