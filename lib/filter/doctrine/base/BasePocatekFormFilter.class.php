<?php

/**
 * Pocatek filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePocatekFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typ_uctu'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'bu' => 'bu', 'sp' => 'sp'))),
      'mena'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'stav'       => new sfWidgetFormFilterInput(),
      'urok'       => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'typ_uctu'   => new sfValidatorChoice(array('required' => false, 'choices' => array('bu' => 'bu', 'sp' => 'sp'))),
      'mena'       => new sfValidatorChoice(array('required' => false, 'choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'stav'       => new sfValidatorPass(array('required' => false)),
      'urok'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('pocatek_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pocatek';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'typ_uctu'   => 'Enum',
      'mena'       => 'Enum',
      'stav'       => 'Text',
      'urok'       => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
