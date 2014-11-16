<table width="100%">
    <tr>
        <th>Karta</th><th>datum</th><th>castka</th><th>Obchodnik</th><th>misto</th><th>realizuj</th>
    </tr><?php
    foreach ($blk as $value) {        
    ?>
    <tr>
        <td><?php echo $value->getKarta(); ?></td>
        <td><?php echo $value->getDatum(); ?></td>
        <td><?php echo $value->getCastka(); ?></td>
        <td><?php echo $value->getObchod(); ?></td>
        <td><?php echo $value->getMisto(); ?></td>
        <td><?php echo link_to('Realizuj','@prevod_blok?id='.$value->getId()) ?></td>        
    </tr><?php
    }
    ?>
</table>