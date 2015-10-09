<h2>Deposer un avis</h2>

<?php

if(isset($_SESSION["user"])){
	$id_game = $_GET["id_game"];
	$id_client = $_SESSION["user"]->cli_id;

echo "<form name='addForm' class='form-horizontal' action='?r=avi/add&id_game=".$id_game."&id_client=".$id_client."' method='post'>"; ?>
	<div class="form-group">
		<label class="control-label col-sm-2" >Titre : </label>
		<div class='col-sm-10'>
			<input type="text" class="form-control" name="titre"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Note : </label>
		<div class='col-sm-10'>
			<select class="form-control" name="note" >
				<?php for($i=1;$i<=5;$i++){
						echo "<option value=".$i.">".$i." / 5</option>"; 
				} 	?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" >Détail : </label>
		<div class='col-sm-10'>
			<textarea class="form-control" name="detail"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2"></label>
		<div class='col-sm-10'>
			<input type="submit" name="addbtn" value="Ajouter" class="btn btn-primary"/>
		</div>
	</div>	
</form>

<?php
}
else echo "Vous devez être connecté pour déposer un avis.";