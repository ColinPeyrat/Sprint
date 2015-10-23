<div class="row">
    <h2>Mes Adresses</h2>
    <div class="col-md-3">

        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="./?r=cli">Mes informations</a></li>
            <li role="presentation"><a href="./?r=cli/adresse">Mes Adresses</a></li>
            <li role="presentation"><a href="./?r=cli/orders" >Mes commandes</a><li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Relais <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a href="./?r=cli/myRelay" >Mes relais</a><li>
                    <li role="presentation"><a href="./?r=cli/relay" >Ajouter un relais</a><li>
                </ul>
            </li>
        </ul>
        </li>
    </div>
    <div class="col-md-9">
        <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tous mes relais</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <?php if(empty($data)){ ?>
                                    <tr>
                                        <td><b>Vous n'avez aucun point de relais, vous pouvez en choisir un <a
                                                    href="?r=cli/relay">ici</a></b></td>
                                    </tr>
                                <?php } else {?>
                                <tr>
                                    <td>Nom</td>
                                    <td>Rue</td>
                                    <td>CP</td>
                                    <td>Ville</td>
                                    <td>Pays</td>
                                </tr>
                                <?php foreach($data as $key => $relay): ?>
                                    <tr>
                                        <td><?= $relay->T_E_RELAIS_REL->rel_nom ?></td>
                                        <td><?= $relay->T_E_RELAIS_REL->rel_rue ?></td>
                                        <td><?= $relay->T_E_RELAIS_REL->rel_cp ?></td>
                                        <td><?= $relay->T_E_RELAIS_REL->rel_ville ?></td>
                                        <td><?= $relay->T_E_RELAIS_REL->T_R_PAYS_PAY->pay_nom ?></td>
                                        <td><a href="?r=rec/removeRelay&rel_id=<?= $relay->T_E_RELAIS_REL->rel_id ?>">Supprimer</a></td>
                                    </tr>
                                <?php endforeach ?>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
<?php
