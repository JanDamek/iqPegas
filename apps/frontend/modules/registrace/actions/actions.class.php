<?php

/**
 * registrace actions.
 *
 * @package    iqPegas konfig
 * @subpackage registrace
 * @author     Jan Damek
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registraceActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward('registration', 'new');
//        $this->form = new RegistrationForm();
//        
//        $this->field_names = array();
//        foreach ($this->form->getValidatorSchema()->getFields() as $name => $field) {
//            if ($this->form->getCSRFFieldName() != $name)
//                $this->field_names[] = $name;
//        }

    }

    public function executeSendmail(sfWebRequest $request) {    
        $this->hash = $request->getParameter('hash');

        $this->no = Doctrine::getTable('SendedEmail')
                ->findOneByHesh($this->hash);

        if (!$this->no) {
            //hash jeste neni, mohu zaslat email a vlozit info o mailu
            $et = Doctrine::getTable('EmailTexts')
                    ->findOneByTypeOfMail('registrace');

            if ($et) {

                $reg = Doctrine::getTable('Registration_check')
                        ->createQuery('Registration_check r')
                        ->leftJoin('r.Registration r1')
                        ->where('r.hesh=?', $this->hash)
                        ->execute();
                $reg = $reg[0];
                $reg = $reg->getRegistration();

                $body = $et->getBody();

                $link = $this->generateUrl('potvrzeni', array('hesh' => $this->hash), true);
                $this->body = str_replace("@@link", $link, $body);

                //priprava emailu
                $m = $this->getMailer();

                $message = $m->compose(
                        //sender
                        array('iqpegas@atohm.cz' => 'registrace'),
                        //resiver
                        array($reg->getEmail() => $reg->getName()),
                        //subject
                        $et->getSubject(),
                        //body
                        ''
                );

                //odeslani
//                try {
                    $message->setBody('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cz" lang="cz"><head></head><body>'
                        .$this->body.'</body></html>','text/html');
                    $m->send($message);
                    //pri potvrzeni prijeti, vlozit do odeslanych
                    $insert = "insert into sended_email set hesh='" . $this->hash . "', reg_id = " . $reg->getId() . ", mail_id=" . $et->getId() . ", sended_od=now(), created_at=now(), updated_at=now()";

                    Doctrine_Manager::connection()
                            ->execute($insert);

//                } catch (Exception $exc) {
//                    $this->error = "NoSended";
//                }
            } else {
                $this->error = 'NeniTextMailu';
            }
        } else {
            $this->error = 'MailJizOdeslan';
        }
    }

    public function executeNewlink(sfWebRequest $request) {
        $hesh = $request->getParameter('hesh');
        $h = Doctrine::getTable('Registration_check')
                ->findOneByHesh($hesh);
        if ($h) {
            //stary kod nalezen, muzeme zaslat novy
            $hash = md5(time());
            $h->setHesh($hash);
            $h->setInProcess(false);
            $h->save();
            
            $request->setParameter('hash', $hash);
            $this->forward('registrace', 'sendmail');
        } else {
            //stary hesh jiz neni, nutna nova registrace
            $this->no_hash = true;
        }
    }

    public function executePotvrzeni(sfWebRequest $request) {
        $hesh = $request->getParameter('hesh');
        $this->hash = $hesh;
        if ($hesh) {
            //prislo potvrzeni, nutno zkontrololovat
            $h = Doctrine::getTable('Registration_check')
                    ->findOneByHesh($hesh);
            if ($h) {
                if (!$h->getInProcess()) {
                    //hash nalezen, zkontroluj email
                    $m = Doctrine::getTable('SendedEmail')
                            ->findOneByHesh($hesh);
                    if ($m) {
                        //nalezen take mail
                        $m->setSendSuccess(true);
                        $m->save();
                    } else {
                        //info ze neni mail
                        $this->bez_mailu = true;
                    }
                    $h->setInProcess(true);
                    $h->save();
                } else {
                    $this->inProces = true;
                }
            } else {
                $this->no_hash = true;
            }
        } else {
            //neni hash, je tam chyba
            $this->no_hash = true;
        }
    }

}
