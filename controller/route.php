<?php

// Gestion des routes
// Déclenchement automatique des controleurs
// ToDo : gestion des erreurs d'accès


// Accès POST ou GET indifférent
$parameters = array();
if (isset($_POST))
	foreach($_POST as $k=>$v)
		$parameters[$k] = $v;
if (isset($_GET))
	foreach($_GET as $k=>$v)
		$parameters[$k] = $v;
if (isset($_FILES))
	foreach($_FILES as $k=>$v)
		$parameters[$k] = $v;

// Pour accès ultérieur sans "global"
function parameters() {
	global $parameters;
	return $parameters;
}

$tables = [
	'adr' => 'T_E_ADRESSE_ADR',
	'avi' => 'T_E_AVIS_AVI',
	'cli' => 'T_E_CLIENT_CLI',
	'con' => 'T_E_COMMANDE_COM',
	'jeu' => 'T_E_JEUVIDEO_JEU',
	'mot' => 'T_E_MOTCLE_MOT',
	'pho' => 'T_E_PHOTO_PHO',
	'rel' => 'T_E_RELAIS_REL',
	'vid' => 'T_E_VIDEO_VID',
	'ale' => 'T_J_ALERTE_ALE',
	'ava' => 'T_J_AVISABUSIF_AVA',
	'avd' => 'T_J_AVISDECONSEILLE_AVD',
	'avr' => 'T_J_AVISRECOMMANDE_AVR',
	'fav' => 'T_J_FAVORI_FAV',
	'gej' => 'T_J_GENREJEU_GEJ',
	'jer' => 'T_J_JEURAYON_JER',
	'lec' => 'T_J_LIGNECOMMANDE_LEC',
	'rec' => 'T_J_RELAISCLIENT_REC',
	'con' => 'T_R_CONSOLE_CON',
	'edi' => 'T_R_EDITEUR_EDI',
	'gen' => 'T_R_GENRE_GEN',
	'pay' => 'T_R_PAYS_PAY',
	'ray' => 'T_R_RAYON_RAY',
	'srv' => 'SERVICE_VENTE'
];

// Gestion des la route : paramètre r = controller/action
if (isset(parameters()["r"])) {

	if(strlen(parameters()["r"]) > 3  ) {

		//TRANSFORME LE cli/login en T_E_CLIENT_CLI/login
		list($route, $osef) = $route = explode("/", parameters()["r"]);

		//recupere le vrai nombre de la table
		$route = $tables[$route];
		//remet le bon nom du controller

		$route = $route."/".$osef;
	} else {
		//ne marche que si on a rien apres le / par exemple ?r=jeu (si on a ?r=jeu/add ca foire)
		$route = strtolower($tables[parameters()["r"]]);
	}

	if (strpos($route,"/") === FALSE)
		list($controller, $action) = array($route, "index");
	else {
		list($controller, $action) = explode("/", $route);
	}

	$controller = strtoupper($controller)."Controller";
	$m = new message();


	//Autorise la partis de gestion des ventes seuelement au utilisateur ayant le role Service vente
	if($controller == "SERVICE_VENTEController")
	{
		if(!isset($_SESSION['user'])) {
			$c = new T_E_CLIENT_CLIController();
			$m->setFlash("Veuillez d'abord vous connecter");
			$controller = "T_E_CLIENT_CLIController";
			$action = "login";
		} else if($_SESSION['user']->role != "Service vente"){
			$m->setFlash("Espace du site reservé au service vente.");
			$controller = "SiteController";
			$action = "index";
		}
	}
	$c = new $controller();
	$c->$action();

} else {

	$c = new SiteController();
	$c->index();

}
