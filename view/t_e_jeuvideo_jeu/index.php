<table>
<?php
foreach($data as $jeu){
    echo "<tr>";
    echo "<td>".$jeu->jeu_nom."</td>";
    echo "<td>".$jeu->T_R_EDITEUR_EDI->edi_nom."</td>";
    echo "</tr>";
}
?>
</table>