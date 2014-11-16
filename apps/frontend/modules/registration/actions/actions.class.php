<?php

require_once dirname(__FILE__) . '/../lib/registrationGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/registrationGeneratorHelper.class.php';

/**
 * registration actions.
 *
 * @package    iqPegas konfig
 * @subpackage registration
 * @author     Jan Damek
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registrationActions extends autoRegistrationActions {

    public function executeNew(sfWebRequest $request) {
        parent::executeNew($request);
    }

    public function executeEdit(sfWebRequest $request) {
        parent::executeEdit($request);
        //pokud to dojde sem je zaznam ulozen a mohu presmerovat na odeslani mailu
        $hash = md5(time());

        $insert = "INSERT INTO registration_check SET reg_id=" . $request->getParameter('id') . ", hesh='" . $hash . "', created_at=now(), updated_at=now() ";
        Doctrine_Manager::connection()
                ->execute($insert);

        $this->redirect('@sendmail_localized?hash=' . $hash);
    }

}
