<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NavigationHelper
 *
 * @author damek
 */
class NavigationHelper {

    //put your code here
    private static
    $instance = null;
        
    private function __construct() {

    }

    private function __clone() {

    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new NavigationHelper;
        }
        return self::$instance;
    }

    public static function setMetaData(sfResponse $response) {
        $custom_description = '';
        $custom_keywords = '';
        $custom_title = '';
        $h1_in_item = false;

        if (empty($custom_keywords)) {
            $custom_keywords = '';
        }
        if (empty($custom_description)) {
            $custom_description = '';
        }

        $response->addMeta('keywords', $custom_keywords . ' ' . sfConfig::get('app_general_keywords'));
        $response->addMeta('description', $custom_description . ' ' . sfConfig::get('app_general_description'));
        if (empty($custom_title)) {
            if (self::$page > 1) {
                $custom_title .= " strana " . self::$page;
            }
            $response->setTitle('IQ Pegas ' . $custom_title);
            $response->setSlot('h1', 'IQ Pegas ' . $custom_title);
        } else {
            $response->setTitle($custom_title . ' | IQ Pegas');
            if (!$h1_in_item)
                $response->setSlot('h1', $custom_title . ' | IQ Pegas');
        }
    }

    public static function getSetting() {
        if (self::$setting) {
            return self::$setting;
        } else {
            self::$setting = Doctrine::getTable('Setting')->findOneById(1);
            return self::$setting;
        }
    }

}

?>
