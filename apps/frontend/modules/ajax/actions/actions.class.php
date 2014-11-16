<?php

/**
 * ajax actions.
 *
 * @package    iqPegas konfig
 * @subpackage ajax
 * @author     Jan Damek
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ajaxActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    protected function validateField($field_name, $field_value) {

        try {
            $reserved = Doctrine::getTable('reserved')
                    ->createQuery('Reserved r')
                    ->select('r.word')
                    ->execute()
                    ->toArray();

            $forbidden = Doctrine::getTable('notallowed')
                    ->createQuery('Notallowed n')
                    ->select('n.word')
                    ->execute()
                    ->toArray();

            $r = array();
            foreach ($reserved as $value) {
                $r[] = $value['word'];
            }
            $f = array();
            foreach ($forbidden as $value) {
                $f[] = $value['word'];
            }

            switch ($field_name) {
                case 'domain':
                    $validator = new sfValidatorBlacklist(array(
                        'case_sensitive' => false,
                        'forbidden_values' => $f,
                        'reserved_values' => $r));
                    $validator->clean($field_value);
                    $json = true;

                    break;

                case 'name':
                    $validator = new sfValidatorBlacklist(array(
                        'case_sensitive' => false,
                        'forbidden_values' => $f,
                        'reserved_values' => $r));
                    $validator->clean($field_value);
                    $json = true;

                    break;

                case 'email':
                    $validator = new sfValidatorEmail();
                    $validator->clean($field_value);
                    $json = true;

                    break;

                default:
                    break;
            }
        } catch (sfValidatorError $validatorError) {
            //TODO: Support I18N
            //sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
            $json = str_replace('%value%', $field_value, $validatorError->getMessage());
        }
        return json_encode($json);
    }

    public function executeValidate(sfWebRequest $request) {

        $field_name = $request->getParameter('field');
        $field_value = $request->getParameter('value');

        $json = $this->validateField($field_name, $field_value);

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');

        return $this->renderText($json);
    }

    public function executeDomain(sfWebRequest $request) {
        $this->renderText(Doctrine_Inflector::urlize($request->getParameter('domain', '')));
    }

    public function executeKdo(sfWebRequest $request) {
        $osu['kdo'] = $request->getParameter('kdo');
        $osu['kod'] = $request->getParameter('kod');
        $osu['obsah'] = $request->getParameter('o');

        if ($request->getParameter('r') == 'mail') {
            $s = new Sms();
            $s->kdo = $osu['kdo'];
            $s->kod = $osu['kod'];
            $s->obsah = $osu['obsah'];
            $s->overeno = true;
            $s->odeslano = false;
            $s->save();
//            $insert = 'insert into sms set kdo="' . $osu['kdo'] . '", kod="' . $osu['kod'] . '" , obsah="' . $osu['obsah'] . '", odeslano=0, overeno=1,created_at = NOW(),' .
//                    'updated_at = NOW()';
//            Doctrine_Manager::connection()->exec($insert);
        } elseif ($request->getParameter('r') == '1212124545') {
            $s = Doctrine::getTable('Sms')
                            ->createQuery('Sms s')
                            ->select('s.id, s.kod, s.kdo, s.obsah')
                            ->where('s.odeslano = 0')
                            ->orderBy('s.id')
                            ->limit(1)
                            ->execute()->toArray();

            //var_dump($s);
            if (isset($s[0])) {
                $s = $s[0];
                $osu['kdo'] = $s['kdo'];
                $osu['kod'] = $s['kod'];
                $osu['obsah'] = $s['obsah'];

                $u = 'update sms set odeslano=1 where id=' . $s['id'];
                Doctrine_Manager::connection()->exec($u);
            } else {
                $osu['kdo'] = '';
                $osu['kod'] = '';
                $osu['obsah'] = '';
            }
        } elseif ($request->getParameter('r') == '1234567890') {
            $s = Doctrine::getTable('Sms')
                            ->createQuery('Sms s')
                            ->select('s.id, s.kod, s.kdo, s.obsah')
                            ->where('s.overeno = 0')
                            ->andWhere('s.odeslano = 1')
                            ->orderBy('s.id')
                            ->limit(1)
                            ->execute()->toArray();

            //var_dump($s);
            if (isset($s[0])) {
                $s = $s[0];
                $osu['kdo'] = $s['kdo'];
                $osu['kod'] = $s['kod'];
                $osu['obsah'] = $s['obsah'];

                $u = 'update sms set overeno=1 where id=' . $s['id'];
                Doctrine_Manager::connection()->exec($u);
            } else {
                $osu['kdo'] = '';
                $osu['kod'] = '';
                $osu['obsah'] = '';
            }
        } elseif ($request->getParameter('r') == '8585748798') {
                            $s = new Sms();
                            $s->kdo = $osu['kdo'];
                            $s->kod = $osu['kod'];
                            $s->obsah = $osu['obsah'];
                            $s->overeno = false;
                            $s->odeslano = false;                            
                            $s->save();
//            $insert = 'insert into sms set kdo="' . $osu['kdo'] . '", kod="' . $osu['kod'] . '" , obsah="' . $osu['obsah'] . '", odeslano=0, created_at = NOW(),' .
//                    'updated_at = NOW()';
//            Doctrine_Manager::connection()->exec($insert);
        } elseif ($request->getParameter('r') == 'blok') {

            if ($osu['kod'] == '1') {
                $s = Doctrine::getTable('Blokace')
                        ->createQuery('Blokace s')
                        ->select('s.id, s.datum, s.castka, s.obchod, s.typ, s.misto')
                        ->orderBy('s.datum desc')
                        ->where('s.realizovano=?', 0)
                        ->addOrderBy('s.created_at desc')
                        ->execute();
            } else if ($osu['kod'] == '2') {
                $s = Doctrine::getTable('Blokace')
                        ->createQuery('Blokace s')
                        ->select('s.id, s.datum, s.castka, s.obchod, s.typ, s.misto')
                        ->orderBy('s.datum desc')
                        ->addOrderBy('s.created_at desc')
                        ->where('karta = ?', 'PK: 408364XXXXXX2884')
                        ->andWhere('s.realizovano=?', 0)
                        ->execute();
            } else if ($osu['kod'] == '3') {
                $s = Doctrine::getTable('Blokace')
                        ->createQuery('Blokace s')
                        ->select('s.id, s.datum, s.castka, s.obchod, s.typ, s.misto')
                        ->orderBy('s.datum desc')
                        ->addOrderBy('s.created_at desc')
                        ->where('karta = ?', 'PK: 408359XXXXXX6465')
                        ->andWhere('s.realizovano=?', 0)
                        ->execute();
            }

            $osu = array();
            foreach ($s as $item) {
                $originalDate = $item->getDatum();
                $newDate = date("d.m.Y", strtotime($originalDate));
                $osu[] = array('datum' => $newDate,
                    'c' => number_format($item->getCastka(), 2, ',', ' '),
                    'castka' => $item->getCastka(),
                    'o' => $item->getObchod(),
                    't' => $item->getTyp(),
                    'm' => $item->getMisto(),
                    'cas' => '11:04');
            }
            $osu['obsah'] = '1';
        } elseif ($request->getParameter('r') == 'blokc') {
            $s = Doctrine::getTable('Blokace')
                    ->createQuery('Blokace s')
                    ->select('SUM(s.castka) as castka')
                    ->where('s.realizovano=?', 0)
                    ->fetchOne();

            $osu = array();
            $osu[] = array(
                'c' => number_format($s->getCastka(), 2, ',', ' '),
                'castka' => $s->getCastka());
            $osu['obsah'] = '1';
        }

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
//        if ($osu['obsah'] != '') {
//            return $this->renderText(json_encode($osu));
//        } else
            return $this->renderText('{"kdo","kod","obsah"}');
    }

    public function executeStav(sfWebRequest $request) {
        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
//        $start = $request->getParameter('S_firstpos',1);

        $s = Doctrine::getTable('Pohyby')
                ->createQuery('Pohyby p')
                ->select('*')
                ->where('p.typ_uctu = ?', $request->getParameter('ucet'))
                ->andWhere('p.realizovano = ?', 1)
                ->andWhere('p.mena = ?', $request->getParameter('mena'))
                ->orderBy('p.datum desc')
                ->addOrderBy('p.cas desc')
//                ->limit($start,50)
                ->execute();

        $osu = $s->toArray();

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        if ($osu != '') {
            return $this->renderText(json_encode($osu));
        } else
            return $this->renderText('{}');
    }

    public function executeZustatek(sfWebRequest $request) {
        $p = Doctrine::getTable('Pocatek')
                ->createQuery('Pocatek p')
                ->select('*')
                ->execute();
        foreach ($p as $value) {
            $stav[$value->getTypUctu()][$value->getMena()]['stav'] = $value->getStav();
        }
        $p = Doctrine::getTable('Kurz')
                ->createQuery('Kurz p')
                ->select('*')
                ->execute();
        foreach ($p as $value) {
            $stav['bu'][$value->getMena()]['kurz'] = $value->getKurz();
            if ($value->getMena() == 'CZK') {
                $stav['sp'][$value->getMena()]['kurz'] = $value->getKurz();
            }
        }

        $s = Doctrine::getTable('Pohyby')
                ->createQuery('Pohyby p')
                ->select('p.typ_uctu, p.mena, SUM(p.castku)-SUM(p.poplatek)-SUM(p.zprava) as castku')
                ->where('p.realizovano = ?', 1)
                ->groupBy('p.typ_uctu')
                ->addGroupBy('p.mena')
                ->execute()
                ->toArray();

        foreach ($s as $key => $value) {
            $stav[$value['typ_uctu']][$value['mena']]['stav'] += $value['castku'];
        }

        $s = Doctrine::getTable('Blokace')
                ->createQuery('Blokace s')
                ->select('SUM(s.castka) as castka')
                ->where('s.realizovano=?', 0)
                ->fetchOne();

        $stav['sp']['CZK']['blok'] = 0;
        $stav['sp']['CZK']['avl'] = $stav['sp']['CZK']['stav'] - $stav['sp']['CZK']['blok'];
        $stav['sp']['CZK']["disp"] = $stav['sp']['CZK']['avl'];

        $stav['bu']['CZK']['blok'] = $s->getCastka();
        $stav['bu']['CZK']['avl'] = $stav['bu']['CZK']['stav'] - $stav['bu']['CZK']['blok'];

        $stav['bu']['USD']['blok'] = 0;
        $stav['bu']['USD']['avl'] = $stav['bu']['USD']['stav'] - $stav['bu']['USD']['blok'];

        $stav['bu']['EUR']['blok'] = 0;
        $stav['bu']['EUR']['avl'] = $stav['bu']['EUR']['stav'] - $stav['bu']['EUR']['blok'];

        $stav['bu']['CZK']["disp"] = $stav['bu']['CZK']["avl"] + ($stav['bu']['EUR']["avl"] * $stav['bu']['EUR']["kurz"]) + ($stav['bu']['USD']["avl"] * $stav['bu']['USD']["kurz"]);
        $stav['bu']['EUR']["disp"] = ($stav['bu']['CZK']["avl"] / $stav['bu']['EUR']["kurz"]) + $stav['bu']['EUR']["avl"] + (($stav['bu']['USD']["avl"] * $stav['bu']['USD']["kurz"]) / $stav['bu']['EUR']["kurz"]);
        $stav['bu']['USD']["disp"] = ($stav['bu']['CZK']["avl"] / $stav['bu']['EUR']["kurz"]) + $stav['bu']['USD']["avl"] + (($stav['bu']['EUR']["avl"] * $stav['bu']['EUR']["kurz"]) / $stav['bu']['USD']["kurz"]);

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText(json_encode($stav));
    }

    private function kod() {
        $s = '';
        for ($i = 0; $i < 11; $i++) {
            $n = rand(0, 9);
            $s .=$n;
        }
        return $s;
    }

    private function addPohyb($tr) {
        $dateObj = \DateTime::createFromFormat("d.m.Y", $tr['do']);
        $do = $dateObj->format("Y-m-d");

        $dateObj = \DateTime::createFromFormat("d.m.Y", $tr['datum']);
        $datum = $dateObj->format("Y-m-d");
        
        $p = new Pohyby();
        $p->realizovano=1;
        $p->typ_uctu = $tr['tu'];
        $p->typ = $tr['typ'];
        $p->mena = "CZK";
        $p->kod_transakce = $this->kod();
        $p->datum = $datum;
        $p->z_uctu = ($tr['tu'] == 'bu' ? '5353802001' : '5353802028' );
        $p->v_mene = "CZK";
        $p->na_ucet = $tr['naucet'];
        $p->kod_banky = $tr['kodb'];
        $p->castku = $tr['c'];
        $p->meny  = "CZK";
        $p->kurz = 1;
        $p->zprava = ((integer) $tr['poplatek'] * 4);
        $p->poplatek = 0;
        $p->variabilni_symbol = $tr['vs'];
        $p->konstantni_symbol = $tr['ks'];
        $p->specificky_symbol =  $tr['ss'];
        $p->prevest_dne = $datum;
        $p->ukonceni_platnosti = $do;
        $p->zprava_pro_prijemce = $tr['prijemce'];
        $p->zprava_pro_mne = $tr['p_m'];
        $p->umoznit_castecnou_realizaci = 0;
        $p->cas= $tr['cas'];
        $p->save();
//        $sql = 'insert into pohyby set ' .
//                'realizovano=1, ' .
//                'typ_uctu = "' . $tr['tu'] . '", ' .
//                'typ = "' . $tr['typ'] . '" ,' .
//                'mena = "CZK", ' .
//                'kod_transakce = ' . $this->kod() . ', ' .
//                'datum = "' . $datum . '", ' .
//                'z_uctu = ' . ($tr['tu'] == 'bu' ? '5353802001' : '5353802028' ) . ', ' .
//                'v_mene = "CZK", ' .
//                'na_ucet = "' . $tr['naucet'] . '", ' .
//                'kod_banky = "' . $tr['kodb'] . '", ' .
//                'castku = ' . $tr['c'] . ', ' .
//                'meny  = "CZK", ' .
//                'kurz = 1, ' .
//                'zprava = ' . ((integer) $tr['poplatek'] * 4) . ' ,' .
//                'poplatek = 0, ' .
//                'variabilni_symbol = "' . $tr['vs'] . '", ' .
//                'konstantni_symbol = "' . $tr['ks'] . '", ' .
//                'specificky_symbol = "' . $tr['ss'] . '", ' .
//                'prevest_dne = "' . $datum . '", ' .
//                'ukonceni_platnosti = "' . $do . '", ' .
//                'zprava_pro_prijemce = "' . $tr['prijemce'] . '", ' .
//                'zprava_pro_mne = "' . $tr['p_m'] . '", ' .
//                'umoznit_castecnou_realizaci = 0, ' .
//                'created_at = NOW(),' .
//                'updated_at = NOW(),' .
//                'cas= "' . $tr['cas'] . '" ';
//        Doctrine_Manager::connection()->exec($sql);
    }

    public function executeAdd(sfWebRequest $request) {

        $stav = array();
        $tr = '';
        if ($request->getParameter('se', 1) == '0') {
            $noty = false;
        } else {
            $noty = true;
        }
        $cas = $request->getParameter('cas', date('H:i'));
        //prevod ze sp
        if ($request->getParameter('z_uctu') == '5353802028') {
            if ($request->getParameter('na_ucet') == '5353802001') {
                $pr = 'Kateřina Damková';
                $h = str_replace(" ", "", $request->getParameter('castku'));
                $h = str_replace(",", ".", $h);
                $tr = array(
                    'tu' => 'bu',
                    'typ' => 'Příchozí platba',
                    'cas' => $cas,
                    'datum' => $request->getParameter('prevest_dne'),
                    'do' => $request->getParameter('ukonceni_platnosti'),
                    'p_m' => $request->getParameter('zprava_pro_prijemce'),
                    'c' => $h,
                    'poplatek' => ($h >= 10000) && $noty,
                    'naucet' => $request->getParameter('z_uctu'),
                    'kodb' => $request->getParameter('kod_banky'),
                    'prijemce' => $pr,
                    'vs' => $request->getParameter('variabilni_symbol'),
                    'ks' => $request->getParameter('konstantni_symbol'),
                    'ss' => $request->getParameter('specificky_symbol'),
                    'cr' => 9);
                $this->addPohyb($tr);
                if ($h >= 10000 && $noty) {
                    $s = 'RB: * Info o platbe * Z: ' . $request->getParameter('z_uctu') . '/5500 * Na: 5353802001/5500 * Realizovano: ' . $request->getParameter('castku') . ' CZK * Dne: ' . $request->getParameter('prevest_dne') . ' ' . $cas . ' * Konstantni symbol: ' . $request->getParameter('konstantni_symbol') . ' * Variabilni symbol:' . $request->getParameter('variabilni_symbol');
                    $o = urlencode($s);
                    file_get_contents("http://rbapprb.appspot.com/auth.php?kdo=mail&kod=00000000000" . "&o=" . $o);
                }
            } else {
                $pr = '';
            }

            $h = str_replace(" ", "", $request->getParameter('castku'));
            $h = '-' . str_replace(",", ".", $h);
            $tr = array(
                'tu' => 'sp',
                'typ' => 'Převod',
                'cas' => $cas,
                'datum' => $request->getParameter('prevest_dne'),
                'do' => $request->getParameter('ukonceni_platnosti'),
                'p_m' => $request->getParameter('zprava_pro_mne'),
                'c' => $h,
                'poplatek' => 0,
                'naucet' => $request->getParameter('na_ucet'),
                'kodb' => $request->getParameter('kod_banky'),
                'prijemce' => $pr,
                'vs' => $request->getParameter('variabilni_symbol'),
                'ks' => $request->getParameter('konstantni_symbol'),
                'ss' => $request->getParameter('specificky_symbol'),
                'cr' => 10);
            $this->addPohyb($tr);
        }

        //prevod z BU na SP
        else if ($request->getParameter('z_uctu') == '5353802001') {
            if ($request->getParameter('na_ucet') == '5353802028') {
                $pr = 'Kateřina Damková';

                $pr = 'Kateřina Damková';
                $h = str_replace(" ", "", $request->getParameter('castku'));
                $h = str_replace(",", ".", $h);
                $tr = array(
                    'tu' => 'sp',
                    'typ' => 'Příchozí platba',
                    'cas' => $cas,
                    'datum' => $request->getParameter('prevest_dne'),
                    'do' => $request->getParameter('ukonceni_platnosti'),
                    'p_m' => $request->getParameter('zprava_pro_prijemce'),
                    'c' => $h,
                    'poplatek' => 0,
                    'naucet' => $request->getParameter('z_uctu'),
                    'kodb' => $request->getParameter('kod_banky'),
                    'prijemce' => $pr,
                    'vs' => $request->getParameter('variabilni_symbol'),
                    'ks' => $request->getParameter('konstantni_symbol'),
                    'ss' => $request->getParameter('specificky_symbol'),
                    'cr' => 9);
                $this->addPohyb($tr);
            } else {
                $pr = '';
            }

            $h = str_replace(" ", "", $request->getParameter('castku'));
            $h = '-' . str_replace(",", ".", $h);
            $tr = array(
                'tu' => 'bu',
                'cas' => $cas,
                'typ' => 'Převod',
                'datum' => $request->getParameter('prevest_dne'),
                'do' => $request->getParameter('ukonceni_platnosti'),
                'p_m' => $request->getParameter('zprava_pro_mne'),
                'c' => $h,
                'poplatek' => 0,
                'naucet' => $request->getParameter('na_ucet'),
                'kodb' => $request->getParameter('kod_banky'),
                'prijemce' => $pr,
                'vs' => $request->getParameter('variabilni_symbol'),
                'ks' => $request->getParameter('konstantni_symbol'),
                'ss' => $request->getParameter('specificky_symbol'),
                'cr' => 10);
            $this->addPohyb($tr);
        } else {
            if ($request->getParameter('na_ucet') == '5353802001') {
                $pr = $request->getParameter('prijemce');

                $h = str_replace(" ", "", $request->getParameter('castku'));
                $h = str_replace(",", ".", $h);
                $tr = array(
                    'tu' => 'bu',
                    'typ' => 'Příchozí platba',
                    'cas' => $cas,
                    'datum' => $request->getParameter('prevest_dne'),
                    'do' => $request->getParameter('ukonceni_platnosti'),
                    'p_m' => $request->getParameter('zprava_pro_prijemce'),
                    'c' => $h,
                    'poplatek' => ($h >= 10000) && $noty,
                    'naucet' => $request->getParameter('z_uctu'),
                    'kodb' => $request->getParameter('kod_banky'),
                    'prijemce' => $pr,
                    'vs' => $request->getParameter('variabilni_symbol'),
                    'ks' => $request->getParameter('konstantni_symbol'),
                    'ss' => $request->getParameter('specificky_symbol'),
                    'typ' => $request->getParameter('typ'),
                    'cr' => 9);
                $this->addPohyb($tr);
                if ($h >= 10000 && $noty) {
                    $s = 'RB: * Info o platbe * Z: ' . $request->getParameter('z_uctu') . '/5500 * Na: 5353802001/5500 * Realizovano: ' . $request->getParameter('castku') . ' CZK * Dne: ' . $request->getParameter('prevest_dne') . ' ' . $cas . ' * Konstantni symbol: ' . $request->getParameter('konstantni_symbol') . ' * Variabilni symbol:' . $request->getParameter('variabilni_symbol');
                    $o = urlencode($s);
                    file_get_contents("http://rbapprb.appspot.com/auth.php?kdo=mail&kod=00000000000" . "&o=" . $o);
                }
            } else if ($request->getParameter('na_ucet') == '5353802028') {

                $pr = $request->getParameter('prijemce');
                $h = str_replace(" ", "", $request->getParameter('castku'));
                $h = str_replace(",", ".", $h);
                $tr = array(
                    'tu' => 'sp',
                    'typ' => 'Příchozí platba',
                    'cas' => $cas,
                    'do' => $request->getParameter('prevest_dne'),
                    'datum' => $request->getParameter('ukonceni_platnosti'),
                    'p_m' => $request->getParameter('zprava_pro_prijemce'),
                    'c' => $h,
                    'poplatek' => 0,
                    'naucet' => $request->getParameter('z_uctu'),
                    'kodb' => $request->getParameter('kod_banky'),
                    'prijemce' => $pr,
                    'vs' => $request->getParameter('variabilni_symbol'),
                    'ks' => $request->getParameter('konstantni_symbol'),
                    'ss' => $request->getParameter('specificky_symbol'),
                    'cr' => 9);
                $this->addPohyb($tr);
            }
        }
        $stav['tr'] = $tr;
        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText(json_encode($stav));
    }

    public function executeTrans(sfWebRequest $request) {
        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');

        $s = Doctrine::getTable('Pohyby')
                ->createQuery('Pohyby p')
                ->select('*')
                ->where('p.typ_uctu = ?', $request->getParameter('ucet'))
                ->andWhere('p.mena = ?', $request->getParameter('mena'))
                ->andWhere('p.typ = ? or p.typ = ?', array('Převod', 'Trvalý převod'))
                ->orderBy('p.datum desc')
                ->addOrderBy('p.cas desc')
                ->addOrderBy('p.realizovano')
                ->execute();

        $osu = $s->toArray();

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        if ($osu != '') {
            return $this->renderText(json_encode($osu));
        } else
            return $this->renderText('{}');
    }

    public function executeDenni(sfWebRequest $request) {
        $s = Doctrine::getTable('Pohyby')
                ->createQuery('Pohyby p')
                ->select('p.datum, p.typ_uctu, p.mena, SUM(p.castku)-SUM(p.poplatek)-SUM(p.zprava) as castku')
                ->groupBy('p.typ_uctu')
                ->addGroupBy('p.datum')
                ->addGroupBy('p.mena')
                ->orderBy('p.datum desc')
                ->execute()
                ->toArray();

        foreach ($s as $key => $value) {
            $stav[$value['datum']][$value['typ_uctu']][$value['mena']]['stav'] = $value['castku'];
        }

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText(json_encode($stav));
    }

    public function executeKarta(sfWebRequest $request) {
        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');

        $s = Doctrine::getTable('Pohyby')
                ->createQuery('Pohyby p')
                ->select('*')
                ->where('p.typ_uctu = ?', $request->getParameter('ucet'))
                ->andWhere('p.mena = ?', $request->getParameter('mena'))
                ->andWhere('p.typ = ? or p.typ = ?', array('Platba kartou', 'Výběr z bankomatu'))
                ->orderBy('p.datum desc')
                ->addOrderBy('p.cas desc')
                ->andWhere('p.realizovano = ?', 1)
                ->execute();

        $osu = $s->toArray();

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        if ($osu != '') {
            return $this->renderText(json_encode($osu));
        } else
            return $this->renderText('{}');
    }

    public function executeMesnove(sfWebRequest $request) {
        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');

        $osu = Doctrine::getTable('Zpravy')
                ->createQuery('Zpravy p')
                ->select('*')
                ->where('p.typ_uctu = ?', $request->getParameter('ucet'))
                ->andWhere('p.mena = ?', $request->getParameter('mena'))
                ->andWhere('p.na_top = ?', true)
                ->andWhere('p.no_show = ?', false)
                ->orderBy('p.datum desc')
                ->addOrderBy('p.precteno desc')
                ->limit(4)
                ->execute()
                ->toArray();

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        if ($osu != '') {
            return $this->renderText(json_encode($osu));
        } else
            return $this->renderText('{}');
    }

    public function executeMes(sfWebRequest $request) {
        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');

        $osu = Doctrine::getTable('Zpravy')
                ->createQuery('Zpravy p')
                ->select('*')
                ->where('p.typ_uctu = ?', $request->getParameter('ucet'))
                ->andWhere('p.mena = ?', $request->getParameter('mena'))
                ->andWhere('p.no_show = ?', false)
                ->orderBy('p.datum desc')
                ->execute()
                ->toArray();

        $sql = 'UPDATE zpravy SET precteno = 1 WHERE precteno = 0 and typ_uctu = "' . $request->getParameter('ucet') . '" ' .
                ' and mena = "' . $request->getParameter('mena') . '"';
        Doctrine_Manager::connection()->execute($sql);

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        if ($osu != '') {
            return $this->renderText(json_encode($osu));
        } else
            return $this->renderText('{}');
    }

}
