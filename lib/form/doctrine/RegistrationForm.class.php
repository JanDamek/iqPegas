<?php

/**
 * Registration form.
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RegistrationForm extends BaseRegistrationForm {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'Tag', 'sfAjaxFormValidation'));

        $reserved = Doctrine::getTable('reserved')
                ->createQuery('Reserved r')
                ->select('r.word')
                ->execute()
                ->toArray();

        $forbidden = Doctrine::getTable('notallowed')
                ->createQuery('Notallowed n')
                ->select('n.word')
                ->execute()
                ->toArray();

        $r = array();
        foreach ($reserved as $value) {
            $r[] = $value['word'];
        }
        $f = array();
        foreach ($forbidden as $value) {
            $f[] = $value['word'];
        }

        $this->setValidator('email', 
                new sfValidatorEmail());

        $this->setValidator('name', 
                new sfValidatorBlacklist(array(
            'case_sensitive' => false,
            'forbidden_values' => $f,
            'reserved_values' => $r)));

        $this->setValidator('domain', 
                new sfValidatorBlacklist(array(
            'case_sensitive' => false,
            'forbidden_values' => $f,
            'reserved_values' => $r)));
        
       $this->validatorSchema->setPostValidator( 
               new sfValidatorAnd(
               array(
               new sfValidatorDoctrineUnique(array('model' => 'Registration', 'column' => 'name')),
               new sfValidatorDoctrineUnique(array('model' => 'Registration', 'column' => 'domain')) 
                   )
                )
                ); 
        
        use_ajax_validation_for_form_name('RegistrationForm');
    }

}
