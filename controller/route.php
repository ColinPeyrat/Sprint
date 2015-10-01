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
	'ray' => 'T_R_RAYON_RAY'
];

// Gestion des la route : paramètre r = controller/action
if (isset(parameters()["r"])) {
	
	$route = strtolower($tables[parameters()["r"]]);
	if (strpos($route,"/") === FALSE)
		list($controller, $action) = array($route, "index");
	else
		list($controller, $action) = explode("/", $route);

	$controller = ucfirst($controller)."Controller";
	$c = new $controller();
	$c->$action();	

} else {

	$c = new SiteController();
	$c->index();

}
