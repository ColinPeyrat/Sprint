
<?php
if(count($data)==0){
	echo "<div class='alert alert-warning' role='alert'>Aucun avis trouvé pour ce jeu</div>";

}
else{

	echo "<h2>Avis sur le jeu</h2>";
	foreach($data as $avi){
		echo "<div class='panel panel-default'>";
	    	echo "<div class='panel-heading'><strong>".$avi->avi_titre."</strong> : ".$avi->avi_note." / 5 - <span class='text-capitalize'>".$avi->T_E_CLIENT_CLI->cli_pseudo."</span> <small>(".$avi->avi_date.")</small></div>";
	    	echo "<div class='panel-body'>".$avi->avi_detail."</div>";
  		echo "</div>";
  	}
 }
?>