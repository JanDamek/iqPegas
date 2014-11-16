<?php
use_helper('I18N');
use_helper('Translation');

echo '<h2>'.  __echo('novylink').'</h2><br/>';

if (isset($no_hash)){
   echo "<p>".  __echo('neni hash')."</p>";
}else{
    echo "<p>".  __echo('naMailBylOdeslanNovyHash')."</p>";
}