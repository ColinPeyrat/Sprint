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
                echo "<td>".$product->jeu_nom."</td>";
                echo "<td>".$product->T_R_EDITEUR_EDI->edi_nom."</td>";
                echo "<td>".$product->T_R_CONSOLE_CON->con_nom."</td>";
                echo "<td>".$product->jeu_prixttc." €</td>";
                echo "<td>".$product->jeu_prixttc." €</td>";
                echo '<td><a href="?r=cli/removefromcart&jeu_id='.$product->jeu_id.'" class="btn btn-danger" role="button">Supprimer</a></td>';
            echo "</tr>";
            $prixTotal += $product->jeu_prixttc;
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
        echo "<td><button type='button' class='btn btn-success'>Valider <i class='glyphicon glyphicon-play'></i></button></td>";
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
