<!DOCTYPE html> 
<html>
<head>
	<meta charset="UTF-8">
	<title>FNAC -Jeux</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/animate.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/locales/bootstrap-datepicker.fr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
</head>
<body>
<div class="container">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../Sprint">Fnac</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jeux <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?r=jeu">Voir tous les jeux</a></li>
                            <li class="dropdown-submenu">
                                <a href="?r=jeu/findBySelection" class="dropdown-toggle" data-toggle="dropdown">Chercher un jeu</a>
                                <ul class="dropdown-menu">
                                    <li><a href="?r=jeu/findBySelection">Par console</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
<!--                    <li class="dropdown">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li><a href="#">Action</a></li>-->
<!--                            <li><a href="#">Another action</a></li>-->
<!--                            <li><a href="#">Something else here</a></li>-->
<!--                            <li role="separator" class="divider"></li>-->
<!--                            <li><a href="#">Separated link</a></li>-->
<!--                            <li role="separator" class="divider"></li>-->
<!--                            <li><a href="#">One more separated link</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li><li class="dropdown">
                       <?php if(isset($_SESSION['user'])){

                                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                                echo $_SESSION['user']->cli_prenom." ".$_SESSION['user']->cli_nom." <span class='caret'></span></a>";
                                echo '<ul class="dropdown-menu">';
                                echo '<li><a href="?r=cli"><i class="glyphicon glyphicon-shopping-cart"></i> Mon panier</a></li>';
                                echo '<li role="separator" class="divider"></li>';
                                echo '<li><a href="?r=cli"><i class="glyphicon glyphicon-user"></i> Mon compte</a></li>';
                                echo '<li role="separator" class="divider"></li>';
                                echo '<li><a href="?r=cli/unlog"><i class="glyphicon glyphicon-off"></i> Se deconnecter</a></li>';

                           echo "</ul>";

                            } else {

                                echo "<li><a href='?r=cli/login'>Se connecter</a></li>";
                            }
                            ?></li>
                    <?php
                    if(!isset($_SESSION['user'])){
                        echo "<li><a href='?r=cli/register'>S'inscrire</a></li>";
                    }
                    if(isset($_SESSION['user']) && $_SESSION['user']->role == "Service vente"){
                        echo "<li><a href='?r=srv'>Espace service vente</a></li>";
                    }
                    if(isset($_SESSION['user']) && $_SESSION['user']->role == "Service communication"){
                        echo "<li><a href='?r=src'>Espace service communication</a></li>";
                    }

                    ?>
                </ul>
            </div><!--/.nav-collapse -->
    </nav>
    <?php
        $messages = new message();
        $messages->flash();
    ?>
