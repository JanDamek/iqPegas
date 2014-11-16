<?php
use_helper('I18N');
use_helper('Translation');

echo '<h2>'.  __echo('potvrzeni mailu').'</h2>';

if (isset($no_hash)){
   echo "<p>".  __echo('neni hash')."</p>";
} else
if (isset($bez_mailu)){
   echo "<p>".  __echo('neni mail')."</p>";
} else
if (isset($inProces)){
   echo "<p>".  __echo('hashin proccess')."</p>";
   $s = __echo('Zaslat novy hash na email');
   $s = str_replace("@@link", url_for('@novy_link?hesh='.$hash), $s);
   echo $s;        
} else {
    echo __echo ('potvrzeni_registrace_mailu');
}