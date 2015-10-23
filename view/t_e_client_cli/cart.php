<h1>Votre panier</h1>
<div class="panel panel-primary">
    <div class="panel-heading">Votre panier</div>
    <div class="panel-body">
<?php

if(empty($data)){
    echo "Votre panier est vide";
} else {
    ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>Nom Produit</th>
                    <th>Editeur</th>
                    <th>Console</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                    <th></th>
                </tr>
        <?php
        $prixTotal = 0;
        foreach ($data as $product) {
            echo "<tr>";
                echo "<td><a href='#'  data-toggle='modal' data-target='#myModal".$product->jeu_id."'>".$product->jeu_nom."</a></td>";
                echo "<td>".$product->T_R_EDITEUR_EDI->edi_nom."</td>";
                echo "<td>".$product->T_R_CONSOLE_CON->con_nom."</td>";
                echo "<td>".$product->jeu_prixttc." €</td>";
                echo "<td>".$product->jeu_prixttc." €</td>";
                echo '<td><a href="?r=cli/removefromcart&jeu_id='.$product->jeu_id.'" class="btn btn-danger" role="button">Supprimer</a></td>';
            echo "</tr>";
            $prixTotal += $product->jeu_prixttc;
        ?>
                <div class="col-md-9">
                    <div class="modal fade" id="myModal<?php echo $product->jeu_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo $product->jeu_nom ?></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">Un jeu de <?php echo $product->T_R_EDITEUR_EDI->edi_nom  ?></div>
                                        <div class="panel-body">
                                            <?php
                                            echo "<p><b>Plateforme : </b>".$product->T_R_CONSOLE_CON->con_nom."</p>";
                                            echo "<p><b>Paru le : </b>".$product->jeu_dateparution."</p>";
                                            echo "<div class=''><b>Description : </b>".$product->jeu_description."</div><br/>";
                                            echo "<p><b>Information légale : </b>".$product->jeu_publiclegal."</p>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
        }
        echo "<tr>";
            echo"<td></td>";
            echo"<td></td>";
            echo"<td></td>";
            echo "<td><b class='pull-right'>TOTAL</b></td>";
            echo "<td><b>$prixTotal €</b></td>";
            echo "<td></td>";
        echo "</tr>";
        echo "<tr>";
        echo"<td></td>";
        echo"<td></td>";
        echo"<td></td>";
        echo "<td><a href='?r=jeu' class='btn btn-default pull-right' role='button'><i class='glyphicon glyphicon-shopping-cart'></i>Continuer achats</a></td>";
        echo "<td><a role='button' href='?r=cli/commandChoose' class='btn btn-success'>Passer commande <i class='glyphicon glyphicon-play'></i></a></td>";
        echo "<td></td>";
        echo "</tr>";
//        echo "<tr>";
//        echo "<td><b class='pull-right'>TOTAL</b></td>";
//        echo "<td><b>$prixTotal €</b></td>";
//        echo "<td></td>";
//        echo "</tr>";

        echo '</table>';
//        echo "<p class='text-center'><button type='button' class='btn btn-success'>Valider <i class='glyphicon glyphicon-play'></i></button></p>";
//        echo "<p class='pull-right'><button type='button' class='btn btn-success'>Valider <i class='glyphicon glyphicon-play'></i></button></p>";
    }
?>
    </div>
</div>
<?php
