<h1>Service communication</h1>
<div class="row">
    <div class="col-md-2">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="./?r=src/ava">Gerer les avis abusif</a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <?php
        echo "<table class='table'>";
        echo "<tbody>";
        echo "<thead>";
            echo "<tr>";
            echo "<th>L'avis sur le jeux</th>";
            echo "<th>Signalé par</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
        echo "</thead>";

        foreach ($data as $ava) {
            echo "<tr>";
                echo "<td>".$ava->T_E_AVIS_AVI->T_E_JEUVIDEO_JEU->jeu_nom." "."<a href='#'  data-toggle='modal' data-target='#myModal".$ava->T_E_AVIS_AVI->avi_id."'>Voir l'avis</a>"."</td>";
                echo "<td><small>".$ava->T_E_CLIENT_CLI->cli_civilite."</small> ".$ava->T_E_CLIENT_CLI->cli_nom." ".$ava->T_E_CLIENT_CLI->cli_prenom."</td>";
                echo "<td>"."<a href='?r=src/removeavi&avi_id=".$ava->T_E_AVIS_AVI->avi_id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Supprimer l'avis</a></td>";
                echo "<td>"."<a href='?r=src/removeava&avi_id=".$ava->T_E_AVIS_AVI->avi_id."&cli_id=".$ava->T_E_CLIENT_CLI->cli_id."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Ignorer l'avis abusif</a>"."</td>";
            echo "</tr>";

            ?>
            <div class="col-md-9">
                <div class="modal fade" id="myModal<?php echo $ava->T_E_AVIS_AVI->avi_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Un Avis de <?php echo $ava->T_E_AVIS_AVI->T_E_CLIENT_CLI->cli_civilite."</small> ".$ava->T_E_AVIS_AVI->T_E_CLIENT_CLI->cli_nom." ".$ava->T_E_AVIS_AVI->T_E_CLIENT_CLI->cli_prenom ?></h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">Contenu de l'avis signalé comme abusif</div>
                                    <div class="panel-body">
                                        <?php
                                        echo "<p><b>Date : </b>".$ava->T_E_AVIS_AVI->avi_date."</p>";
                                        echo "<p><b>Titre : </b>".$ava->T_E_AVIS_AVI->avi_titre."</p>";
                                        echo "<div class=''><b>Detail : </b>".$ava->T_E_AVIS_AVI->avi_detail."</div><br/>";
                                        echo "<p><b>Note : </b>".$ava->T_E_AVIS_AVI->avi_note."/5</p>";
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
        echo "</tbody>";
        echo "</table>";

        ?>

    </div>
</div>
