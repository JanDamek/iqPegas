<?php

/**
 * Kurz filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseKurzFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mena'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'kurz'       => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'mena'       => new sfValidatorChoice(array('required' => false, 'choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'kurz'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('kurz_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Kurz';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'mena'       => 'Enum',
      'kurz'       => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
