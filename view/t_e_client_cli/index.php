<?php
if(isset($_SESSION['user'])) {
    ?>
    <h2>Rebonjour,  <?php echo $_SESSION['user']->cli_pseudo ?></h2>
    <a href="?r=cli/unlog">Se deconnecter</a>
    <?php
    $c = new T_E_CLIENT_CLI();
    $c =$_SESSION['user'];
    $c->displayInfo();
    ?>
    <form method="post" action="?r=cli/modify">
        <input name="action" type="submit" value="Modifier son compte" class="btn btn-primary">
    </form>
    <?php


}
else
{
    ?>
    <a href="?r=cli/login">se connecter</a>
    <?php
}
