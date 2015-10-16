<?php
if(isset($_SESSION['user'])) {
    ?>
    <h2>Bonjour,  <?php echo $_SESSION['user']->cli_pseudo ?></h2>
    <br/>
    <?php
    $c = new T_E_CLIENT_CLI();
    $c = $_SESSION['user'];
    $c->displayInfo();
    ?>
    <form method="post" action="?r=cli/modify">
        <input name="action" type="submit" value="Modifier son compte" class="btn btn-primary">
    </form>
    <?php
    echo "<a class='btn btn-primary' href='?r=cli/orders&id_cli=".$_SESSION['user']->cli_id."'>Consulter mes commandes</a>";

}
else
{
    ?>
    <a href="?r=cli/login">se connecter</a>
    <?php
}
