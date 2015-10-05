<?php
if($data == null){
    echo "<div class='alert alert-warning' role='alert'>Cet utilisateur n'existe pas</div>";

} else {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><small><?php echo $data->cli_civilite ?></small><?php echo $data->cli_nom ?> <?php echo $data->cli_prenom ?></h3>
        </div>
        <div class="panel-body">
            <strong>E-mail : </strong><?php echo $data->cli_mel ?>
        </div>
    </div>

    <?php
}