<?php

function pager_navigation($pager)
{
    $pocet = $pager->getMaxPerPage();

    /**
     * pri strankovani fotky, kde je +1 opet odecte pro korektni zobrazeni poctu na strance
     */
    if (($pocet % 10))
        $pocet--;

    /**
     * odstrani strankovani s adresy
     */
    $url = str_replace('/'.$pager->getPage(), '', $_SERVER['REQUEST_URI']);

    $navigation = 
            '
<div class="content-nav">
  <p class="records">
    <span>Zobrazit počet záznamů na stránce:</span>
        <a href="?pocet=10"'.($pocet == 10 ? ' class="current"' : '').'>10</a>
        <a href="?pocet=20"'.($pocet == 20 ? ' class="current"' : '').'>20</a>
        <a href="?pocet=40"'.($pocet == 40 ? ' class="current"' : '').'>40</a>
  </p>';
    $navigation = '';

    if ($pager->haveToPaginate())
    {

        $navigation .='
<div class="content-nav">
  <p class="pagination">';

        for ($i = $pager->getFirstPage(); $i <= $pager->getLastPage(); $i++)
        {
            if ($pager->getLastPage() > 9 and $i == 4 and $pager->getPage() > 5)
                $navigation .= "<span>&#8230;</span>";

            if ($i < 4 or $i > $pager->getLastPage() - 3 or ($i > $pager->getPage() - 2 and $i < $pager->getPage() + 2))
                $navigation .= '<a '.($i == $pager->getPage() ? 'class="current" ' : '' ).'href="'.$url.'/'.$i.'">'.$i.'</a> ';

            if ($pager->getLastPage() > 9 and $i == $pager->getLastPage() - 3 and $pager->getPage() < $pager->getLastPage() - 3)
                $navigation .= "<span>&#8230;</span>";
        }
        $navigation .='
  </p>
</div>';
    }

    return $navigation;
}