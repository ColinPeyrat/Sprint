<?php
if(isset($_SESSION['user'])) {
    ?>
    <h2>Bonjour,  <?php echo $_SESSION['user']->cli_pseudo ?></h2>
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="./?r=cli">Mes informations</a></li>
                <li role="presentation"><a href="./?r=cli/adresse">Mes Adresses</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <?php
            $c = new T_E_CLIENT_CLI();
            $c =$_SESSION['user'];
            $c->displayInfo();
            ?>
            <form method="post" action="?r=cli/modify">
                <input name="action" type="submit" value="Modifier son compte" class="btn btn-primary">
            </form>
        </div>
    </div>
    <?php


}
else
{
    ?>
    <a href="?r=cli/login">se connecter</a>
    <?php
}
