<?php

/**
 * TextyTranslation form.
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TextyTranslationForm extends BaseTextyTranslationForm {

    public function configure() {
        $this->widgetSchema['text'] = new sfWidgetFormTextareaTinyMCE(
                array(
            'width' => 600,
            'height' => 100,
            'config' => 'theme_advanced_disable: "cleanup,help"',
            'theme' => sfConfig::get('app_tinymce_theme', 'advanced'),
                ), array(
            'class' => 'tiny_mce'
                )
        );
    }

}
