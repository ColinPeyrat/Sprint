<h2>Inscription</h2>
<form method="post" action="?r=cli/register" role="form">


    <div class="form-group">
        <label for="mel">E-mail</label>
        <input type="text" class="form-control" name="mel" id="mel" value='<?php if(isset($_POST['mel'])) echo $_POST['mel'] ?>'/>
    </div>
    <div class="form-group">
        <label for="motpasse">Mot de passe</label>
        <input type="password" class="form-control" name="motpasse" id="motpasse"/>
    </div>
    <div class="form-group">
        <label for="motpasseConfirm">Confirmez votre mot de passe</label>
        <input type="password" class="form-control" name="motpasseConfirm" id="motpasseConfirm" />
    </div>
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo" value='<?php if(isset($_POST['pseudo'])) echo $_POST['pseudo'] ?>' />
    </div>
    <div class="form-group">
        <label for="civilite">Civilité</label>
        <select class="form-control" name="civilite">
            <option value="">--Choisissez--</option>
            <option value="M.">M.</option>
            <option value="Mme">Mme</option>
            <option value="Mlle">Mlle</option>
        </select>
    </div>

    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom" value='<?php if(isset($_POST['nom'])) echo $_POST['nom'] ?>' />
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" value='<?php if(isset($_POST['prenom'])) echo $_POST['prenom'] ?>' />
    </div>
    <div class="form-group">
        <label for="telfixe">Téléphone fixe</label>
        <input type="text" class="form-control" name="telfixe" id="telfixe" value='<?php if(isset($_POST['telfixe'])) echo $_POST['telfixe'] ?>' />
        <p>Au moins un des deux numéros de téléphone est obligatoire</p>
    </div>
    <div class="form-group">
        <label for="telportable">Téléphone portable</label>
        <input type="text" class="form-control" name="telportable" id="telportable" value='<?php if(isset($_POST['telportable'])) echo $_POST['telportable'] ?>'/>
    </div>


    <input name="action" type="submit" value="S'inscrire" class="btn btn-primary" />
</form>
<?php
