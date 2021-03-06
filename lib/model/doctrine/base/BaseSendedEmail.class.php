<?php

/**
 * BaseSendedEmail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $reg_id
 * @property string $hesh
 * @property integer $mail_id
 * @property date $sended_od
 * @property boolean $send_success
 * @property EmailTexts $EmailTexts
 * @property Registration $Registration
 * 
 * @method integer      getId()           Returns the current record's "id" value
 * @method integer      getRegId()        Returns the current record's "reg_id" value
 * @method string       getHesh()         Returns the current record's "hesh" value
 * @method integer      getMailId()       Returns the current record's "mail_id" value
 * @method date         getSendedOd()     Returns the current record's "sended_od" value
 * @method boolean      getSendSuccess()  Returns the current record's "send_success" value
 * @method EmailTexts   getEmailTexts()   Returns the current record's "EmailTexts" value
 * @method Registration getRegistration() Returns the current record's "Registration" value
 * @method SendedEmail  setId()           Sets the current record's "id" value
 * @method SendedEmail  setRegId()        Sets the current record's "reg_id" value
 * @method SendedEmail  setHesh()         Sets the current record's "hesh" value
 * @method SendedEmail  setMailId()       Sets the current record's "mail_id" value
 * @method SendedEmail  setSendedOd()     Sets the current record's "sended_od" value
 * @method SendedEmail  setSendSuccess()  Sets the current record's "send_success" value
 * @method SendedEmail  setEmailTexts()   Sets the current record's "EmailTexts" value
 * @method SendedEmail  setRegistration() Sets the current record's "Registration" value
 * 
 * @package    iqPegas konfig
 * @subpackage model
 * @author     Jan Damek
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSendedEmail extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sended_email');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('reg_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('hesh', 'string', 32, array(
             'type' => 'string',
             'length' => 32,
             ));
        $this->hasColumn('mail_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('sended_od', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('send_success', 'boolean', null, array(
             'type' => 'boolean',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('EmailTexts', array(
             'local' => 'mail_id',
             'foreign' => 'id'));

        $this->hasOne('Registration', array(
             'local' => 'reg_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}