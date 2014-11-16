<?php

/**
 * rrrrrr actions.
 *
 * @package    iqPegas konfig
 * @subpackage rrrrrr
 * @author     Jan Damek
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rrrrrrActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->blk = Doctrine::getTable('Blokace')
                ->createQuery('B lokace b')
                ->select('*')
                ->where('b.realizovano = ?', 0)
                ->orderBy('b.datum desc')
                ->execute();
    }

    private function kod() {
        $s = '';
        for ($i = 0; $i < 11; $i++) {
            $n = rand(0, 9);
            $s .=$n;
        }
        return $s;
    }

    public function executeBlok(sfWebRequest $request) {
        $blk = Doctrine::getTable('Blokace')
                ->createQuery('Blokace b')
                ->select('*')
                ->where('b.id = ?', $request->getParameter('id'))
                ->fetchOne();
        $blk->set('realizovano', '1');
        $blk->save();

        $product = new Pohyby();
        $product->set('typ_uctu', 'bu');
        $product->set('mena', 'CZK');
        $product->set('typ', $blk->getTyp());
        $product->set('karta', $blk->getKarta());
        $product->set('kod_transakce', $this->kod());
        $product->set('datum', Date('Y-m-d'));
        $product->set('cas', Date('H:i'));
        $product->set('z_uctu', '5353802001');
        $product->set('v_mene', 'CZK');
        $product->set('na_ucet', '8323453');
        $product->set('kod_banky', '5500');
        $product->set('castku', $blk->getCastka() * -1);
        $product->set('meny', 'CZK');
        $product->set('prevest_dne', $blk->getDatum());
        $product->set('ukonceni_platnosti', Date('Y-m-d'));
        $product->set('zprava_pro_prijemce', $blk->getKarta());
        $product->set('zprava_pro_mne', $blk->getObchod());
        $product->set('umoznit_castecnou_realizaci', false);
        $product->set('realizovano', true);
        $product->save();

        $this->forward('rrrrrr', 'index');
    }

    public function executeKomp(sfWebRequest $request) {

        $m = date('i');
        $h = date('H');

        //realizace
        $n = Doctrine::getTable('Pohyby')
                ->createQuery('Pohyby p')
                ->select('*')
                ->where('p.realizovano = ?', 0)
                ->andWhere('p.datum <= NOW()')
                ->andWhere('p.cas <= ?', $h . ':' . $m)
                ->execute();
        foreach ($n as $value) {
            if ($value->getMeny() != 'CZK') {
                $c = $value->getCastku() * $value->getKurz();
            } else
                $c = $value->getCastku();
            if ($c >= 10000) {
                $c = number_format($value->getCastku(), 2, ',', ' ');
                $datum = date("d.m.Y", strtotime($value->getDatum()));
                $o = 'RB: * Info o platbe * Z: ' .
                        $value->getNaUcet() . '/' . $value->getKodBanky() .
                        ' * Na: 5353802001/5500 * Realizovano: ' . $c . ' ' . $value->getMeny() .
                        ' * Dne: ' . $datum .
                        ' ' . $value->getCas() . ' * Konstantni symbol: ' . $value->getKonstantniSymbol() .
                        ' * Variabilni symbol:' . $value->getVariabilniSymbol();

                $s = new Sms();
                $s->kdo = 'mail';
                $s->kod = '0000000000';
                $s->obsah = $o;
                $s->overeno = true;
                $s->odeslano = false;
                $s->save();
                if ($value->getMeny() != 'CZK') {
                    $value->set('zprava', 4 / $value->getKurz());
                } else
                    $value->set('zprava', 4);
            }
            $value->set('realizovano', 1);
        }
        $n->save();

        //kompenzace a ukonceni prevodu
        $n = Doctrine::getTable('Pohyby')
                ->createQuery('Pohyby p')
                ->select('*')
                ->where('p.na_kompenzaci = ?', 1)
                ->andWhere('p.typ_uctu = ?', 'bu')
                ->andWhere('p.typ = ?', 'Převod')
                ->andWhere('p.cas_kompenzace < ?', $h . ':' . $m)
                ->andWhere('p.datum_pripsani <= ?', date('Y-m-d'))
                ->andWhere('p.ukonceni_platnosti >= ?', date('Y-m-d'))
                ->execute();

        foreach ($n as $value) {
            $kdy = date("Y-m-d", time() + 86400);
            $value->set('datum_pripsani', $kdy);

            if ($value->getUkonceniPlatnosti() <= date('Y-m-d')) {
                $s = new Pohyby();

                $s->typ_uctu = $value->getTypUctu();
                $s->mena = $value->getMena();
                $s->typ = 'Storno převodu';
                $s->karta = $value->getKarta();
                $s->kod_transakce = $this->kod();
                $s->datum = date('Y-m-d');
                $s->cas = $h . ':' . $m;
                $s->z_uctu = $value->getZUctu();
                $s->v_mene = $value->getVMene();
                $s->na_ucet = $value->getNaUcet();
                $s->kod_banky = $value->getKodBanky();
                $s->castku = $value->getCastku() * -1;
                $s->meny = $value->getMeny();
                $s->kurz = $value->getKurz();
                $s->variabilni_symbol = $value->getVariabilniSymbol();
                $s->konstantni_symbol = $value->getKonstantniSymbol();
                $s->specificky_symbol = $value->getSpecifickySymbol();
                $s->prevest_dne = date('Y-m-d');
                $s->ukonceni_platnosti = date('Y-m-d');
                $s->zprava_pro_prijemce = '';
                $s->zprava_pro_mne = 'Konec platnosti příkazu k úhradě';
                $s->umoznit_castecnou_realizaci = false;
                $s->realizovano = true;

                if ($s->getCastku() > 10000) {
                    $c = number_format($s->getCastku(), 2, ',', ' ');
                    $datum = date("d.m.Y", strtotime($s->getDatum()));
                    $o = 'RB: * Info o platbe * Z: ' .
                            $s->getNaUcet() . '/' . $s->getKodBanky() .
                            ' * Na: 5353802001/5500 * Realizovano: ' . $c . ' CZK * Dne: ' . $datum .
                            ' ' . $s->getCas() . ' * Konstantni symbol: ' . $s->getKonstantniSymbol() .
                            ' * Variabilni symbol:' . $s->getVariabilniSymbol();

                    $sms = new Sms();
                    $sms->kdo = 'mail';
                    $sms->kod = '0000000000';
                    $sms->obsah = $o;
                    $sms->overeno = true;
                    $sms->odeslano = false;
                    $sms->save();

                    $s->set('zprava', 4);
                }
                $s->save();
            }

            $k = new Pohyby();

            $k->datum = date('Y-m-d');
            $k->cas = $h . ':' . $m;
            $k->typ = 'Kompenzace';
            $k->typ_uctu = 'bu';
            $k->mena = 'CZK';
            $k->kod_transakce = $this->kod();
            $k->z_uctu = '5353802001';
            $k->v_mene = 'CZK';
            $k->na_ucet = '8058332223';
            $k->kod_banky = '5500';
            $c = $value->getCastkaKompenzace();
            if ($c <= 0) {
                $c = ($value->getCastku() * -1) * (18002.98 / 3000500);
            }
            $k->castku = $c;
            $k->meny = 'CZK';
            $k->prevest_dne = date('Y-m-d');
            $k->ukonceni_platnosti = date('Y-m-d');
            $k->zprava_pro_prijemce = 'Nedodržení termínu bankou';
            $castka = number_format($value->getCastku() * -1, 2, ',', ' ');
            $datum = date("d.m.Y", strtotime($value->getDatum()));
            $k->zprava_pro_mne = 'Úrok za pozdní platbu ' . $castka . ' ze dne ' . $datum . ' * 1 den';
            $k->umoznit_castecnou_realizaci = false;
            $k->realizovano = true;

            if ($c >= 10000) {
                $c = number_format($c, 2, ',', ' ');
                $datum = date("d.m.Y", strtotime($k->getDatum()));
                $o = 'RB: * Info o platbe * Z: ' .
                        $k->getNaUcet() . '/' . $k->getKodBanky() .
                        ' * Na: 5353802001/5500 * Realizovano: ' . $c . ' CZK * Dne: ' . $datum .
                        ' ' . $k->getCas() . ' * Konstantni symbol: ' . $k->getKonstantniSymbol() .
                        ' * Variabilni symbol:' . $k->getVariabilniSymbol();

                $s = new Sms();
                $s->kdo = 'mail';
                $s->kod = '0000000000';
                $s->obsah = $o;
                $s->overeno = true;
                $s->odeslano = false;
                $s->save();

                $k->set('zprava', 4);
            }

            $k->save();
        }
        $n->save();

        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText('{}');
    }

}
