<?php
$cli_id = $data;
echo "<p id='secret' class='hidden' data-user=".$data."></p>";
?>
<div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="./?r=cli">Mes informations</a></li>
                <li role="presentation"><a href="./?r=cli/adresse">Mes Adresse</a></li>
                <li role="presentation"><a href="./?r=cli/relay">Mes relais</a></li>
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
        </div>
        <div class="col-md-9">
        	<h2>Ajouter un relais</h2>
        	<div id="googleMap" style="width:600px;height:480px;"></div>
        </div>
    </div>

    
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="public/js/maps.js"></script>
