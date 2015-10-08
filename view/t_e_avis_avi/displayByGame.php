
<?php
if(count($data)==0){
	echo "<div class='alert alert-warning' role='alert'>Aucun avis trouvé pour ce jeu</div>";

}
else{
	echo "<h2>Avis sur le jeu</h2>";
	foreach($data as $avi){
		$star = "";
		//créer des étoiles vides
		for ($i = 0; $i <= 5; $i++) {
			$stars[$i] = "<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>";
		}
		//remplis les étoiles vides selon la note
		for ($i = 0; $i < $avi->avi_note; $i++) {
			$stars[$i] = "<span class='glyphicon glyphicon glyphicon-star' aria-hidden='true'></span>";
		}
		for ($i = 0; $i < 5; $i++) {
			$star .= $stars[$i];
		}
		echo "<div class='panel panel-default'>";
	    	echo "<div class='panel-heading'><strong>".$avi->avi_titre."</strong> : ".$star." - <span class='text-capitalize'><a href='?r=cli/viewOne&id_cli=".$avi->T_E_CLIENT_CLI->cli_id."'>".$avi->T_E_CLIENT_CLI->cli_pseudo."</a>	</span> <small>(".$avi->avi_date.")</small><small><div class='pull-right'><a href='?r=avi/signal&id_avi=".$avi->avi_id."'>Signaler ce commentaire comme abusif</a></div></small></div>";
	    	echo "<div class='panel-body'>".$avi->avi_detail."</div>";
  		echo "</div>";
  	}
 }
?>