<h2>Les jeux</h2>
<!--Modal for ajax-->
<link href="public/css/shop-homepage.css" rel="stylesheet">
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Produit ajouté</h4>
			</div>
			<div class="modal-body">
				<p>Votre article a bien été ajouté au panier</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Continuer mes achats</button>
				<button type="button" id="gotocart" class="btn btn-default" data-dismiss="modal">Voir mon panier</button>
			</div>
		</div>

	</div>
</div>
<div class="modal fade" id="errorModal" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="text-danger modal-title"><i class="glyphicon glyphicon-remove"></i> Erreur</h4>
			</div>
			<div class="modal-body">
				<p>Vous avez déja ajouté cet article !</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			</div>
		</div>

	</div>
</div>
<!--End of modal for ajax-->
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

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php

			foreach($data[0] as $jeu){
			    echo '<div class="col-sm-3 col-lg-3 col-md-3">';
                    echo '<div class="thumbnail">';
                        if(isset($jeu->photo[0]))
							echo "<img src='".$jeu->photo."'>";
                        echo '<div class="caption">';
			                echo '<h4><a href="#">'.$jeu->jeu_nom.'</a>';
			                echo '</h4>';
			                echo '<p>Editeur : '.$jeu->T_R_EDITEUR_EDI->edi_nom.'<br/>Console : '.$jeu->T_R_CONSOLE_CON->con_nom.'</p>';

                        echo '</div>';
                        echo '<div class="ratings">';
							echo '<button type="button" value="'.$jeu->jeu_id.'" class="btn btn-primary btn-sm addtocart">Ajouter au panier</button>';
							echo "<p class='pull-right'><a href='?r=avi/findByGame&id_game=".$jeu->jeu_id."'> Avis </a><</p>";
                            echo '<p><h4>'.$jeu->jeu_prixttc.'€</h4><p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
			}

			?>
		</div>
	</div>
</div>

