<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cz" lang="cz">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <script type="text/javascript">
            var menu = function() {
                var t = 15, z = 50, s = 6, a;
                function dd(n) {
                    this.n = n;
                    this.h = [];
                    this.c = []
                }
                dd.prototype.init = function(p, c) {
                    a = c;
                    var w = document.getElementById(p), s = w.getElementsByTagName('ul'), l = s.length, i = 0;
                    for (i; i < l; i++) {
                        var h = s[i].parentNode;
                        this.h[i] = h;
                        this.c[i] = s[i];
                        h.onmouseover = new Function(this.n + '.st(' + i + ',true)');
                        h.onmouseout = new Function(this.n + '.st(' + i + ')');
                    }
                }
                dd.prototype.st = function(x, f) {
                    var c = this.c[x], h = this.h[x], p = h.getElementsByTagName('a')[0];
                    clearInterval(c.t);
                    c.style.overflow = 'hidden';
                    if (f) {
                        p.className += ' ' + a;
                        if (!c.mh) {
                            c.style.display = 'block';
                            c.style.height = '';
                            c.mh = c.offsetHeight;
                            c.style.height = 0
                        }
                        if (c.mh == c.offsetHeight) {
                            c.style.overflow = 'visible'
                        }
                        else {
                            c.style.zIndex = z;
                            z++;
                            c.t = setInterval(function() {
                                sl(c, 1)
                            }, t)
                        }
                    } else {
                        p.className = p.className.replace(a, '');
                        c.t = setInterval(function() {
                            sl(c, -1)
                        }, t)
                    }
                }
                function sl(c, f) {
                    var h = c.offsetHeight;
                    if ((h <= 0 && f != 1) || (h >= c.mh && f == 1)) {
                        if (f == 1) {
                            c.style.filter = '';
                            c.style.opacity = 1;
                            c.style.overflow = 'visible'
                        }
                        clearInterval(c.t);
                        return
                    }
                    var d = (f == 1) ? Math.ceil((c.mh - h) / s) : Math.ceil(h / s), o = h / c.mh;
                    c.style.opacity = o;
                    c.style.filter = 'alpha(opacity=' + (o * 100) + ')';
                    c.style.height = h + (d * f) + 'px'
                }
                return{dd: dd}
            }();
        </script> 
        <script type="text/javascript">
            sfMediaBrowserWindowManager.init('backend.php/sf_media_browser/select');
        </script>
        <style type="text/css" >
            body {margin:5px; font:12px Verdana,Arial; }
            ul.menu {list-style:none; margin:0; padding:0}
            ul.menu * {margin:0; padding:0}
            ul.menu a {display:block; color:#000; text-decoration:none;list-style: none}
            ul.menu li {position:relative; float:left; margin-right:2px;list-style: none}
            ul.menu ul {position:absolute; top:26px; left:-1px; background:#d1d1d1; display:none; opacity:0; list-style:none}
            ul.menu ul li {position:relative; border:1px solid #aaa; border-top:none; width:112px; margin-left: 0px;list-style: none;font-size: 11px;}
            ul.menu ul li a {display:block; padding:3px 7px 5px; background-color:#d1d1d1}
            ul.menu ul li a:hover {background-color:#c5c5c5}
            ul.menu ul ul {left:98px; top:-1px}
            ul.menu .menulink {border:1px solid #aaa; padding:5px 7px 7px; font-weight:bold; width:98px}
            ul.menu .topline {border-top:1px solid #aaa}
        </style>
    </head>
    <body>
        <?php
        $routing = sfContext::getInstance()->getRouting();
        $uri = $routing->getCurrentInternalUri(true);

        $culture = array('cs' => 'Cesky', 'sk' => 'Slovensky', 'en' => 'Anglicky', 'de' => 'Nemecky');

        foreach ($culture as $key => $value) {
            echo '<div class="lang">';
            echo '<form action="' . url_for($uri) . '" method="get"><input type="hidden" name="sf_culture" value="' . $key . '" />';
            echo '<input type="submit" value="' . __($value) . '"/></form></div>';
        }
        echo '<div class="clear"></div>';

        if ($sf_user->isAuthenticated()) :
            ?>
            <div style="width: 100%; height: 40px">
                <ul class="menu" id="menu">
                    <li class="menulink"><?php echo __('Registrace') ?>
                        <ul>
                            <li><?php echo link_to(__('Predregistrace'), 'registration/index', array('class' => 'sub')); ?></li>
                            <li><?php echo link_to(__('Potvrzene registrace'), '@registration_check', array('class' => 'sub')); ?></li>
                            <li><?php echo link_to(__('Kompletni registrace'), 'registration_complet/index', array('class' => 'sub')); ?></li>
                        </ul>
                    </li>
                    <li class="menulink"><?php echo __('Email') ?> 
                        <ul>
                            <li><?php echo link_to(__('Texty mailu'), '@email_texts', array('class' => 'sub')); ?></li>
                            <li><?php echo link_to(__('Odeslane maily'), '@sended_email', array('class' => 'sub')); ?></li>                            
                        </ul>
                    </li>
                    <li class="menulink"><?php echo __('Omezeni') ?>
                        <ul>
                            <li><?php echo link_to(__('Rezervovane slova'), 'reserved/index', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Nedovolene vyrazy'), 'notallowed/index', array('class' => 'sub')) ?></li>
                        </ul>
                    </li>
                            <li class="menulink"><?php echo __('Texty') ?> 
                                <ul>
                                    <li><?php echo link_to(__('Texty na webu'), '@texty', array('class' => 'sub')); ?></li>
                                </ul>
                            </li>
                    <li class="menulink"><?php echo __('Administrace') ?>
                        <ul>
                            <li><?php echo link_to(__('Správci'), '@sf_guard_user', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Skupiny'), '@sf_guard_group', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Prava'), '@sf_guard_permission', array('class' => 'sub')) ?></li>
                        </ul>
                    </li>
                    <li class="menulink"><?php echo __('Moje') ?>
                        <ul>
                            <li><?php echo link_to(__('Pohyby'), '@pohyby', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Sms'), '@sms', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Blokace'), '@blokace', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Kurz'), '@kurz', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Pocatek'), '@pocatek', array('class' => 'sub')) ?></li>
                            <li><?php echo link_to(__('Zpravy'), '@zpravy', array('class' => 'sub')) ?></li>
                        </ul>
                    </li>
                    <li class="menulink">
                        <?php echo link_to(__('Odhlasit'), '@sf_guard_signout', array('class' => 'sub')) ?>                       
                    </li>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $sf_content ?>
        <script type="text/javascript">
            var menu = new menu.dd("menu");
            menu.init("menu", "menuhover");
        </script>
    </body>
</html>
