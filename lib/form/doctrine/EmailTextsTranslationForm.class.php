<?php

/**
 * EmailTextsTranslation form.
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmailTextsTranslationForm extends BaseEmailTextsTranslationForm {

    public function configure() {
        $this->widgetSchema->moveField('subject', sfWidgetFormSchema::FIRST);

        $this->widgetSchema['body'] = new sfWidgetFormTextareaTinyMCE(
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
