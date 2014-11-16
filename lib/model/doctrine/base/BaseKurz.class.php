<?php

/**
 * BaseKurz
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property enum $mena
 * @property double $kurz
 * 
 * @method enum   getMena() Returns the current record's "mena" value
 * @method double getKurz() Returns the current record's "kurz" value
 * @method Kurz   setMena() Sets the current record's "mena" value
 * @method Kurz   setKurz() Sets the current record's "kurz" value
 * 
 * @package    iqPegas konfig
 * @subpackage model
 * @author     Jan Damek
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseKurz extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('kurz');
        $this->hasColumn('mena', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'CZK',
              1 => 'USD',
              2 => 'EUR',
             ),
             'unique' => true,
             ));
        $this->hasColumn('kurz', 'double', null, array(
             'type' => 'double',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}