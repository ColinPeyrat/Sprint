<h2>Les jeux</h2>
<table class="table table-condensed">

<form class="form-inline" action="?r=jeu" method='post'>
	<div class="form-group col-xs-2">
		<select class="form-control" name="typesearch">
			<option value="tous">Tous</option>
			<option value="console">Type de console</option>
			<?php
			foreach($data[1] as $ray){
				echo"<option value='".$ray->ray_id."'>".$ray->ray_nom."</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group col-xs-3">
		<input type="text" name="searchinput" class="form-control">
	</div>
	<button type="submit" name="searchbtn" value="search" class="btn btn-primary">Chercher</button>	
</form>

<?php
		var_dump($data);
if(isset($data[2])){
	foreach($data[2] as $jeu){

	    echo "<tr>";
	    echo "<td>".$jeu->jeu_nom."</td>";
	    echo "<td>".$jeu->T_R_EDITEUR_EDI->edi_nom."</td>";
	    echo "</tr>";

	}
}

else{
	foreach($data[0] as $jeu){
	    echo "<tr>";
	    echo "<td>".$jeu->jeu_nom."</td>";
	    echo "<td>".$jeu->T_R_EDITEUR_EDI->edi_nom."</td>";
	    echo "</tr>";
	}
}
?>
</table>