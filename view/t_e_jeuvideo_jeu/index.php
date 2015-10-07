<h2>Les jeux</h2>


<table class="table table-condensed">
<form class="form-inline" action="?r=jeu" method='post'>
	<div class="form-group col-xs-2">
		<select class="form-control" name="typesearch">
			<option value="tous">Tous</option>
			<?php
			foreach($data[1] as $ray){
				if(isset($_POST["typesearch"])){
					if($_POST["typesearch"] == $ray->ray_id){
						echo"<option value='".$ray->ray_id."' selected>".$ray->ray_nom."</option> \n";
					} else {
						echo"<option value='".$ray->ray_id."'>".$ray->ray_nom."</option> \n";
					}
				} else {
						echo"<option value='".$ray->ray_id."'>".$ray->ray_nom."</option> \n";
				}
			}
			?>
		</select>
	</div>
	<div class="form-group col-xs-3">
		<input type="text" name="searchinput" class="form-control" value=<?php if(isset($_POST["searchinput"])){echo "'".$_POST["searchinput"]."'";} ?>>
	</div>
	<button type="submit" name="searchbtn" value="search" class="btn btn-primary">Chercher</button>	
</form>

<?php

if(isset($data[2])){
	foreach($data[2] as $jeu){

		echo "<tr>";
		echo "<td><img src='".$jeu->photo."'></td>";
	    echo "<td>".$jeu->jeu_nom."</td>";
	    echo "<td>".$jeu->jeu_prixttc."€</td>";
	    echo "<td>".$jeu->T_R_EDITEUR_EDI->edi_nom."</td>";
	  	echo "<td>".$jeu->T_R_CONSOLE_CON->con_nom."</td>";
	  	echo "<td><a href='?r=avi/findByGame&id_game=".$jeu->jeu_id."'> Avis </a></td>";
	    echo "</tr>";

	}
}

else{
	if(isset($data[0])){
		foreach($data[0] as $jeu){
			echo "<tr>";
			echo "<td><img src='".$jeu->photo."'></td>";
		    echo "<td>".$jeu->jeu_nom."</td>";
		    echo "<td>".$jeu->jeu_prixttc."€</td>";
		    echo "<td>".$jeu->T_R_EDITEUR_EDI->edi_nom."</td>";
		  	echo "<td>".$jeu->T_R_CONSOLE_CON->con_nom."</td>";
		  	echo "<td><a href='?r=avi/findByGame&id_game=".$jeu->jeu_id."'> Avis </a></td>";
		    echo "</tr>";
		}
	}
}
?>
</table>