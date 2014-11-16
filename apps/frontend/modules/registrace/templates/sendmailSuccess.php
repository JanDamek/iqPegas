<?php
use_helper('I18N');
use_helper('Translation');

if ($no && !isset($error)) {
    ?>
    Vse ok.
    <p><?php __echo('Pro tento hash'); ?></p>
    <?php
} else {
    if (isset($error)) {
        echo '<h2>' . __echo($error) . '</h2><br />';
        if (isset($body)) {
            echo '<p>' . __echo('NastalaChyba') . '</p><p>';
            echo sfOutputEscaper::unescape($body) . '</p>';
        } else {
            echo "<p>" . __echo('LinkNaNovyMain') . "</p>";
            echo link_to1(__echo('linkNovyMainLink'), "@novy_link?hesh=" . $hash);
        }
    } else {
        ?>
        <h2><?php echo __echo('Odeslani emailu'); ?></h2>
        <p><?php
            echo __echo('na Vami uvedeny email');
//            echo $hash;
            ?></p>
        <?php
    }
}