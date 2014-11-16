<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TranslationHelper {

    //put your code here
    private static
            $instance = null;
    private
            $trans_table = null;

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new TranslationHelper();
            self::$instance->getTranslate();
        }
        return self::$instance;
    }

    public static function preklad($str) {
        $t = self::getInstance();
        return $t->translate($str);
    }

    public function translate($str) {
        if (isset($this->trans_table[$str])) {
            return $this->trans_table[$str];
        }
        else
            return $str;
    }

    protected function getTranslate() {
        $t = Doctrine::getTable('Texty')
                ->createQuery()
                ->execute();
        $this->trans_table = array();
        foreach ($t as $value) {
            $this->trans_table[$value->getTyp()] = $value->getText();
        }
    }

}

function __echo($str) {
    $s = TranslationHelper::preklad($str);
    if ($s && $s == '') {
        $s = __($str);
    }
    return $s;
}