<?php

/**
 * BaseEmailTexts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property clob $body
 * @property string $subject
 * @property enum $type_of_mail
 * @property Doctrine_Collection $SendedEmail
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method clob                getBody()         Returns the current record's "body" value
 * @method string              getSubject()      Returns the current record's "subject" value
 * @method enum                getTypeOfMail()   Returns the current record's "type_of_mail" value
 * @method Doctrine_Collection getSendedEmail()  Returns the current record's "SendedEmail" collection
 * @method EmailTexts          setId()           Sets the current record's "id" value
 * @method EmailTexts          setBody()         Sets the current record's "body" value
 * @method EmailTexts          setSubject()      Sets the current record's "subject" value
 * @method EmailTexts          setTypeOfMail()   Sets the current record's "type_of_mail" value
 * @method EmailTexts          setSendedEmail()  Sets the current record's "SendedEmail" collection
 * 
 * @package    iqPegas konfig
 * @subpackage model
 * @author     Jan Damek
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEmailTexts extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('email_texts');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('body', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('subject', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('type_of_mail', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'registrace',
              1 => 'potvrzeni',
             ),
             'default' => 'registrace',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('SendedEmail', array(
             'local' => 'id',
             'foreign' => 'mail_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'body',
              1 => 'subject',
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($i18n0);
    }
}