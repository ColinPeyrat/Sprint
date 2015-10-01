<?php
if(isset($_SESSION['user'])) {
    ?>
    <h2>Rebonjour,<?php echo $_SESSION['user']->cli_pseudo ?></h2>
    <a href="?r=cli/unlog">se deconnecter</a>
    <?php
}
else
{
    ?>
    <a href="?r=cli/login">se connecter</a>
    <?php
}
