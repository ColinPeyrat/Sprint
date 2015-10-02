<h2>Les jeux</h2>
<table class="table table-condensed">

<?php
var_dump($data);
foreach($data as $jeu){
    echo "<tr>";
    echo "<td>".$jeu->jeu_nom."</td>";
    echo "<td>".$jeu->T_R_EDITEUR_EDI->edi_nom."</td>";
    echo "</tr>";
}
?>
</table>