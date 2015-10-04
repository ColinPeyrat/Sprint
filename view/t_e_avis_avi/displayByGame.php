
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
	    	echo "<div class='panel-heading'><strong>".$avi->avi_titre."</strong> : ".$star." - <span class='text-capitalize'>".$avi->T_E_CLIENT_CLI->cli_pseudo."</span> <small>(".$avi->avi_date.")</small></div>";
	    	echo "<div class='panel-body'>".$avi->avi_detail."</div>";
  		echo "</div>";
  	}
 }
?>