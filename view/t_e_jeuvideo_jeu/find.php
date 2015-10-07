<h2>Chercher un jeu par plateforme</h2>


<table class="table table-condensed">

<form method="post" class="form-inline" action="?r=jeu/findBySelection">
  <div class="form-group col-xs-2">
	<SELECT class="form-control" name="id_console" >
	<?php foreach(T_R_CONSOLE_CON::findAll() as $console){
		if(isset($_POST["id_console"])){
			if($_POST["id_console"] == $console->con_id){
				echo "<option value=".$console->con_id." selected>".$console->con_nom."</option>";
			} else { 
				echo "<option value=".$console->con_id.">".$console->con_nom."</option>"; }
		} else { 
			echo "<option value=".$console->con_id.">".$console->con_nom."</option>"; } 
	} 	?>
	</SELECT>
  </div>
  <div class="form-group col-xs-3">
  	<input type="submit" name ="action" value="Chercher" class="btn btn-primary">
  </div>
</form>

<?php

if(isset($data)){
	foreach($data as $jeu){
	    echo "<tr>";
	    echo "<td><img src='".$jeu->photo."'></td>";
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