<h2>Chercher un jeu</h2>

<form method="post" action="?r=jeu/findBySelection">
	<label name="console">Plateforme :</label>
	<SELECT name="id_console" >
	<?php foreach(T_R_CONSOLE_CON::findAll() as $console){
		echo "<option value=".$console->con_id.">".$console->con_nom."</option>";
	} ?>
	</SELECT>
	<input type="submit" name ="action" value="Chercher">
</form>