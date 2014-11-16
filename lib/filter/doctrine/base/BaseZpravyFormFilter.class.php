<?php

/**
 * Zpravy filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseZpravyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typ_uctu'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'bu' => 'bu', 'sp' => 'sp'))),
      'mena'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'datum'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'popis'      => new sfWidgetFormFilterInput(),
      'text'       => new sfWidgetFormFilterInput(),
      'precteno'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'typ_uctu'   => new sfValidatorChoice(array('required' => false, 'choices' => array('bu' => 'bu', 'sp' => 'sp'))),
      'mena'       => new sfValidatorChoice(array('required' => false, 'choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'datum'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'popis'      => new sfValidatorPass(array('required' => false)),
      'text'       => new sfValidatorPass(array('required' => false)),
      'precteno'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('zpravy_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Zpravy';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'typ_uctu'   => 'Enum',
      'mena'       => 'Enum',
      'datum'      => 'Date',
      'popis'      => 'Text',
      'text'       => 'Text',
      'precteno'   => 'Boolean',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
