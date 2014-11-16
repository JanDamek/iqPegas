<?php

/**
 * Project form base class.
 *
 * @package    iqPegas konfig
 * @subpackage form
 * @author     Jan Damek
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
    unset($this['created_at'], $this['updated_at']);
    
    if ($this->isI18n())
        $this->embedI18n(array('cs', 'sk', 'en', 'de'));    
  }
}
