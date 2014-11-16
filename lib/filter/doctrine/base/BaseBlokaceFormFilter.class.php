<?php

/**
 * Blokace filter form base class.
 *
 * @package    iqPegas konfig
 * @subpackage filter
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBlokaceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datum'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'castka'      => new sfWidgetFormFilterInput(),
      'karta'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'PK: 408364XXXXXX2884' => 'PK: 408364XXXXXX2884', 'PK: 408359XXXXXX6465' => 'PK: 408359XXXXXX6465'))),
      'mena'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'obchod'      => new sfWidgetFormFilterInput(),
      'typ'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Platba kartou' => 'Platba kartou', 'Výběr z bankomatu' => 'Výběr z bankomatu'))),
      'misto'       => new sfWidgetFormFilterInput(),
      'realizovano' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'datum'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'castka'      => new sfValidatorPass(array('required' => false)),
      'karta'       => new sfValidatorChoice(array('required' => false, 'choices' => array('PK: 408364XXXXXX2884' => 'PK: 408364XXXXXX2884', 'PK: 408359XXXXXX6465' => 'PK: 408359XXXXXX6465'))),
      'mena'        => new sfValidatorChoice(array('required' => false, 'choices' => array('CZK' => 'CZK', 'USD' => 'USD', 'EUR' => 'EUR'))),
      'obchod'      => new sfValidatorPass(array('required' => false)),
      'typ'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Platba kartou' => 'Platba kartou', 'Výběr z bankomatu' => 'Výběr z bankomatu'))),
      'misto'       => new sfValidatorPass(array('required' => false)),
      'realizovano' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('blokace_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Blokace';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'datum'       => 'Date',
      'castka'      => 'Text',
      'karta'       => 'Enum',
      'mena'        => 'Enum',
      'obchod'      => 'Text',
      'typ'         => 'Enum',
      'misto'       => 'Text',
      'realizovano' => 'Boolean',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
