<h2>Modifier l'adresse "<?php echo $data['adresse']->adr_nom ?>"</h2>
<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="./?r=cli">Mes informations</a></li>
            <li role="presentation"><a href="./?r=cli/adresse">Mes Adresses</a></li>
            <li role="presentation"><a href="./?r=cli/orders" >Mes commandes</a><li>
        </ul>
    </div>
    <div class="col-md-9">
        <form id="newadresse" method="post" action="./?r=cli/editadresse&adr_id=<?php echo $data['adresse']->adr_id ?>">
            <input type="text" name="InputId" value="<?php echo $data['adresse']->adr_id ?>" hidden>
            <div class="form-group">
                <label for="InputNom">Nom de l'adresse</label>
                <input type="text" value="<?php echo $data['adresse']->adr_nom ?>" class="form-control" id="InputNom" name="InputNom" placeholder="Nom de l'adresse">
            </div>
            <div class="form-group">
                <label for="InputRue">Rue</label>
                <input type="text" value="<?php echo $data['adresse']->adr_rue ?>" class="form-control" id="InputRue" name="InputRue" placeholder="Rue">
            </div>
            <div class="form-group">
                <label for="InputComplementRue">Complément d'adresse</label>
                <input type="text" value="<?php echo $data['adresse']->adr_complementrue ?>" class="form-control" id="InputComplementRue" name="InputComplementRue" placeholder="Complément d'adresse">
            </div>
            <div class="form-group">
                <label for="InputCP">Code Postal</label>
                <input type="text" value="<?php echo $data['adresse']->adr_cp ?>" class="form-control" id="InputCP" name="InputCP" placeholder="Code Postal">
            </div>
            <div class="form-group">
                <label for="InputVille">Ville</label>
                <input type="text" value="<?php echo $data['adresse']->adr_ville ?>" class="form-control" id="InputVille" name="InputVille" placeholder="Ville">
            </div>
            <div class="form-group">
                <label for="InputPays">Pays</label>
                <select id="InputPays" class="form-control" name="InputPays">
                    <?php foreach($data['pays'] as $k=>$v): ?>
                        <option value="<?php echo $v->pay_id ?>"  <?php if($data['adresse']->T_R_PAYS_PAY->pay_id == $v->pay_id) echo 'selected' ?>><?php echo $v->pay_nom ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>