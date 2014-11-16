<?php

require_once dirname(__FILE__) . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration {

    public function setup() {
        $this->enablePlugins('sfDoctrinePlugin');
        $this->enablePlugins('sfMediaBrowserPlugin');
        $this->enablePlugins('sfFormExtraPlugin');
        $this->enablePlugins('eCropPlugin');
        $this->enablePlugins('sfMediaBrowserPlugin');
        $this->enablePlugins('sfImageTransformPlugin');
        $this->enablePlugins('sfJqueryReloadedPlugin');
        $this->enablePlugins('sfLightboxPlugin');
        $this->enablePlugins('sfAdminThemejRollerPlugin');
        $this->enablePlugins('sfDoctrineGuardPlugin'); 
        $this->enablePlugins('sfAjaxFormValidationPlugin');

    }

}
