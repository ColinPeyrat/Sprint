<h2>Mes Adresse</h2>
<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="./?r=cli">Mes informations</a></li>
            <li role="presentation"><a href="./?r=cli/adresse">Mes Adresse</a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <p>
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Ajouter une adresse</a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="well">
                <form id="newadresse" method="post" action="./?r=cli/adresse">
                    <div class="form-group">
                        <label for="InputNom">Nom de l'adresse</label>
                        <input type="text" value="<?php if(isset($_POST['InputNom'])) echo $_POST['InputNom'] ?>" class="form-control" id="InputNom" name="InputNom" placeholder="Nom de l'adresse">
                    </div>
                    <div class="form-group">
                        <label for="InputPays">Type</label>
                        <select id="InputType" class="form-control" name="InputType">
                            <option <?php if(isset($_POST['InputType']) && $_POST['InputType'] == 'Livraison') echo 'selected' ?>>Livraison</option>
                            <option <?php if(isset($_POST['InputType']) && $_POST['InputType'] == 'Facturation') echo 'selected' ?>>Facturation</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="InputRue">Rue</label>
                        <input type="text" value="<?php if(isset($_POST['InputRue'])) echo $_POST['InputRue'] ?>" class="form-control" id="InputRue" name="InputRue" placeholder="Rue">
                    </div>
                    <div class="form-group">
                        <label for="InputComplementRue">Complément d'adresse</label>
                        <input type="text" value="<?php if(isset($_POST['InputComplementRue'])) echo $_POST['InputComplementRue'] ?>" class="form-control" id="InputComplementRue" name="InputComplementRue" placeholder="Complément d'adresse">
                    </div>
                    <div class="form-group">
                        <label for="InputCP">Code Postal</label>
                        <input type="text" value="<?php if(isset($_POST['InputCP'])) echo $_POST['InputCP'] ?>" class="form-control" id="InputCP" name="InputCP" placeholder="Code Postal">
                    </div>
                    <div class="form-group">
                        <label for="InputVille">Ville</label>
                        <input type="text" value="<?php if(isset($_POST['InputVille'])) echo $_POST['InputVille'] ?>" class="form-control" id="InputVille" name="InputVille" placeholder="Ville">
                    </div>
                    <div class="form-group">
                        <label for="InputPays">Pays</label>
                        <select id="InputPays" class="form-control" name="InputPays">
                            <?php foreach($data['pays'] as $k=>$v): ?>
                                <option value="<?php echo $v->pay_id ?>"  <?php if(isset($_POST['InputPays']) && $_POST['InputPays'] == $v->pay_id) echo 'selected' ?>><?php echo $v->pay_nom ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Ajouter</button>
                </form>
            </div>
        </div>
        <?php foreach($data['adresse'] as $key=>$value): ?>
            <?php if($value->adr_type == 'Facturation'): ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">Adresse de Facturation</div>
                    <div class="panel-body">
                        <address>
                            <strong><?php echo $value->adr_nom ?></strong><br>
                            <?php echo $value->adr_rue ?><?php echo ', '.$value->adr_complementrue ?><br>
                            <?php echo $value->adr_cp ?> - <?php echo $value->adr_ville ?>, <?php echo $value->T_R_PAYS_PAY->pay_nom ?><br>
                        </address>
                    </div>
                    <div class="panel-footer">
                        <a href="" type="button" class="btn btn-primary">Modifier</a>
                        <a href="./?r=cli/adresse&delete=<?php echo $value->adr_id ?>" type="button" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php foreach($data['adresse'] as $key=>$value): ?>
            <?php if($value->adr_type == 'Livraison'): ?>
                <div class="panel panel-info" >
                    <div class="panel-heading" >Adresse de Livraison<a class="btn btn-primary pull-right btn-xs" href="./?r=cli/adresse&putfacturation=<?php echo $value->adr_id; ?>">Mettre en adresse de facturation</a></div>
                    <div class="panel-body">
                        <address>
                            <strong><?php echo $value->adr_nom ?></strong><br>
                            <?php echo $value->adr_rue ?><?php echo ', '.$value->adr_complementrue ?><br>
                            <?php echo $value->adr_cp ?> - <?php echo $value->adr_ville ?>, <?php echo $value->T_R_PAYS_PAY->pay_nom ?><br>
                        </address>
                    </div>
                    <div class="panel-footer">
                        <a href="" type="button" class="btn btn-primary">Modifier</a>
                        <a href="./?r=cli/adresse&delete=<?php echo $value->adr_id ?>" type="button" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>