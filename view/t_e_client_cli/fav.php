<h2> Vos jeux favoris</h2>
<div class="row">
	<div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="./?r=cli">Mes informations</a></li>
            <li role="presentation"><a href="./?r=cli/adresse">Mes Adresses</a></li>
            <li role="presentation"><a href="./?r=cli/orders" >Mes commandes</a><li>
        </ul>
    </div>
    <div class="col-md-9">
<?php
if(isset($data)){
	foreach($data as $jeu){
				    echo '<div class="col-sm-3 col-lg-3 col-md-3">';
	                    echo '<div class="thumbnail">';
	                        if(isset($jeu->photo[0])){
								echo "<img src='".$jeu->photo."'>";
							} else echo "<img src='public/img/default.png'>";
	                        echo '<div class="caption">';
				                echo '<h4><a href="?r=jeu/displayById&jeu_id='.$jeu->jeu_id.'">'.$jeu->jeu_nom.'</a>';

				                echo '</h4>';
				                echo '<p>Editeur : '.$jeu->T_R_EDITEUR_EDI->edi_nom.'<br/>Console : '.$jeu->T_R_CONSOLE_CON->con_nom.'</p>';

	                        echo '</div>';
	                        echo '<div class="ratings">';
	                        	echo "<a href='?r=cli/delfav&id_game=".$jeu->jeu_id."' type='button' value='".$jeu->jeu_id."' class='btn btn-default'>"; 
	                        		if(T_E_CLIENT_CLI::isFav($jeu->jeu_id) == true){
	                        			echo "<span class='glyphicon glyphicon-star starfav'></span>";
	                        		} 
	                        		else {
	                        			echo "<span class='glyphicon glyphicon-star'></span>";
	                        		}
	                        		echo "</a>";
								echo '<button type="button" value="'.$jeu->jeu_id.'" class="btn btn-primary btn-sm addtocart">Ajouter au panier</button>';
								echo "<p class='pull-right'><a href='?r=avi/findByGame&id_game=".$jeu->jeu_id."'> Avis </a><</p>";
	                            echo '<p><h4>'.$jeu->jeu_prixttc.'€</h4><p>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	}
}
	echo "</div>";
echo "</div>";