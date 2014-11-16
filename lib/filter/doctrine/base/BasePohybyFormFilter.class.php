<?php

/**
 * Pohyby filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePohybyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typ_uctu'                    => new sfWidgetFormChoice(array('choices' => array('' => '', 'bu' => 'bu', 'sp' => 'sp'))),
      'mena'                        => new sfWidgetFormChoice(array('choices' => array('' => '', 'CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'typ'                         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Převod' => 'Převod', 'Příchozí platba' => 'Příchozí platba', 'Úrok' => 'Úrok', 'Daň' => 'Daň', 'Platba kartou' => 'Platba kartou', 'Výběr z bankomatu' => 'Výběr z bankomatu', 'Kompenzace' => 'Kompenzace', 'Trvalý převod' => 'Trvalý převod', 'Správa účtu' => 'Správa účtu', 'Poplatek za vedení karty' => 'Poplatek za vedení karty', 'Storno převodu' => 'Storno převodu'))),
      'karta'                       => new sfWidgetFormChoice(array('choices' => array('' => '', 'PK: 408364XXXXXX2884' => 'PK: 408364XXXXXX2884', 'PK: 408359XXXXXX6465' => 'PK: 408359XXXXXX6465'))),
      'kod_transakce'               => new sfWidgetFormFilterInput(),
      'datum'                       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cas'                         => new sfWidgetFormFilterInput(),
      'z_uctu'                      => new sfWidgetFormFilterInput(),
      'v_mene'                      => new sfWidgetFormChoice(array('choices' => array('' => '', 'CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'na_ucet'                     => new sfWidgetFormFilterInput(),
      'kod_banky'                   => new sfWidgetFormFilterInput(),
      'castku'                      => new sfWidgetFormFilterInput(),
      'meny'                        => new sfWidgetFormChoice(array('choices' => array('' => '', 'CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'kurz'                        => new sfWidgetFormFilterInput(),
      'poplatek'                    => new sfWidgetFormFilterInput(),
      'zprava'                      => new sfWidgetFormFilterInput(),
      'variabilni_symbol'           => new sfWidgetFormFilterInput(),
      'konstantni_symbol'           => new sfWidgetFormFilterInput(),
      'specificky_symbol'           => new sfWidgetFormFilterInput(),
      'prevest_dne'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ukonceni_platnosti'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'zprava_pro_prijemce'         => new sfWidgetFormFilterInput(),
      'zprava_pro_mne'              => new sfWidgetFormFilterInput(),
      'umoznit_castecnou_realizaci' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'realizovano'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'typ_uctu'                    => new sfValidatorChoice(array('required' => false, 'choices' => array('bu' => 'bu', 'sp' => 'sp'))),
      'mena'                        => new sfValidatorChoice(array('required' => false, 'choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'typ'                         => new sfValidatorChoice(array('required' => false, 'choices' => array('Převod' => 'Převod', 'Příchozí platba' => 'Příchozí platba', 'Úrok' => 'Úrok', 'Daň' => 'Daň', 'Platba kartou' => 'Platba kartou', 'Výběr z bankomatu' => 'Výběr z bankomatu', 'Kompenzace' => 'Kompenzace', 'Trvalý převod' => 'Trvalý převod', 'Správa účtu' => 'Správa účtu', 'Poplatek za vedení karty' => 'Poplatek za vedení karty', 'Storno převodu' => 'Storno převodu'))),
      'karta'                       => new sfValidatorChoice(array('required' => false, 'choices' => array('PK: 408364XXXXXX2884' => 'PK: 408364XXXXXX2884', 'PK: 408359XXXXXX6465' => 'PK: 408359XXXXXX6465'))),
      'kod_transakce'               => new sfValidatorPass(array('required' => false)),
      'datum'                       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cas'                         => new sfValidatorPass(array('required' => false)),
      'z_uctu'                      => new sfValidatorPass(array('required' => false)),
      'v_mene'                      => new sfValidatorChoice(array('required' => false, 'choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'na_ucet'                     => new sfValidatorPass(array('required' => false)),
      'kod_banky'                   => new sfValidatorPass(array('required' => false)),
      'castku'                      => new sfValidatorPass(array('required' => false)),
      'meny'                        => new sfValidatorChoice(array('required' => false, 'choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'kurz'                        => new sfValidatorPass(array('required' => false)),
      'poplatek'                    => new sfValidatorPass(array('required' => false)),
      'zprava'                      => new sfValidatorPass(array('required' => false)),
      'variabilni_symbol'           => new sfValidatorPass(array('required' => false)),
      'konstantni_symbol'           => new sfValidatorPass(array('required' => false)),
      'specificky_symbol'           => new sfValidatorPass(array('required' => false)),
      'prevest_dne'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'ukonceni_platnosti'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'zprava_pro_prijemce'         => new sfValidatorPass(array('required' => false)),
      'zprava_pro_mne'              => new sfValidatorPass(array('required' => false)),
      'umoznit_castecnou_realizaci' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'realizovano'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('pohyby_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pohyby';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'typ_uctu'                    => 'Enum',
      'mena'                        => 'Enum',
      'typ'                         => 'Enum',
      'karta'                       => 'Enum',
      'kod_transakce'               => 'Text',
      'datum'                       => 'Date',
      'cas'                         => 'Text',
      'z_uctu'                      => 'Text',
      'v_mene'                      => 'Enum',
      'na_ucet'                     => 'Text',
      'kod_banky'                   => 'Text',
      'castku'                      => 'Text',
      'meny'                        => 'Enum',
      'kurz'                        => 'Text',
      'poplatek'                    => 'Text',
      'zprava'                      => 'Text',
      'variabilni_symbol'           => 'Text',
      'konstantni_symbol'           => 'Text',
      'specificky_symbol'           => 'Text',
      'prevest_dne'                 => 'Date',
      'ukonceni_platnosti'          => 'Date',
      'zprava_pro_prijemce'         => 'Text',
      'zprava_pro_mne'              => 'Text',
      'umoznit_castecnou_realizaci' => 'Boolean',
      'realizovano'                 => 'Boolean',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
