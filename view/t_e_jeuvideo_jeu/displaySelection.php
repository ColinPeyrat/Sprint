<h2>Resultat de votre recherche</h2>



<?php
if(count($data)==0){
	echo "<div class='alert alert-warning' role='alert'>Aucun résultat trouvé pour votre recherche.</div>";
}
else{
	echo "<table class='table table-condensed'>";
	foreach($data as $jeu){
	    echo "<tr>";
	    echo "<td>".$jeu->jeu_nom."</td>";
	    echo "<td>".$jeu->jeu_prixttc."€</td>";
	    echo "<td>".$jeu->T_R_EDITEUR_EDI->edi_nom."</td>";
	  	echo "<td>".$jeu->T_R_CONSOLE_CON->con_nom."</td>";
	  	echo "<td><a href='?r=avi/findByGame&id_game=".$jeu->jeu_id."'> Avis </a></td>";
	    echo "</tr>";

	}
	echo "</table>";
}
?>
