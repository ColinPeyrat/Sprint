<?php


class T_E_CLIENT_CLIController extends Controller
{
     public function relay(){
        if(!isset($_SESSION['user'])){
            header("Refresh:0; url=../Sprint/?r=cli/login");
            $m = new message();
            $m->setFlash('Vous devez etre connecté');
        } else {
            $this->render("relay",$_SESSION['user']->cli_id);
        }
    }
    public function myRelay(){
        if(!isset($_SESSION['user'])){
            header("Refresh:0; url=../Sprint/?r=cli/login");
            $m = new message();
            $m->setFlash('Vous devez etre connecté');
        } else {
//            $this->render("relay",$_SESSION['user']->cli_id);
            if(isset($_GET['rel_id']) && !empty($_GET['rel_id'])){
//                $this->render('myRelay',$_)
                $idUser = $_SESSION['user']->cli_id;
                $idRelay = $_GET['rel_id'];
                $m = new message();
                if(T_J_RELAISCLIENT_REC::checkIfRelayClientAlreadyExist($idUser,$idRelay)){
                    $m->setFlash('Vous avez déja ajouté ce relais');
                    header("Refresh:0; url=../Sprint/?r=cli/myRelay");
                } else {
                    T_J_RELAISCLIENT_REC::addRelayClient($_SESSION['user']->cli_id, $_GET['rel_id']);
                    $m->setFlash('Votre relais à bien été ajouté','success');
                    header("Refresh:0; url=../Sprint/?r=cli/myRelay");
                }
            } else {
                $this->render('myRelay',T_J_RELAISCLIENT_REC::findByIdClient($_SESSION['user']->cli_id));
            }
        }
    }
    public static function getFactureAdresse(){
        if(isset($_GET['cli_id'])){
            $idClient = $_GET['cli_id'];
            $client = new T_E_CLIENT_CLI($idClient);
            $allAdress = T_E_ADRESSE_ADR::findByClient($idClient);
            foreach ($allAdress as $key => $addresse) {
                if($addresse->adr_type == "Facturation"){
                    $primaryAdress = $addresse;
                }
            }
            $coordonate = array('latitude' => $primaryAdress->adr_latitude,'longitude' => $primaryAdress->adr_longitude,'nom' => $primaryAdress->adr_nom);
            echo json_encode($coordonate);
        }


    }
     public static function getAllAddresse(){
            $allRelay = T_E_RELAIS_REL::findAll();
            $relays = array();
            foreach ($allRelay as $key => $relay) {
                $relays[] = array('latitude' => $relay->rel_latitude,'longitude' => $relay->rel_longitude, 'nom' => $relay->rel_nom,'addresse' => $relay->rel_rue,'ville' => $relay->rel_ville,'cp' => $relay->rel_cp,'id'=>$relay->rel_id );
            }
            echo json_encode($relays);
                


    }
    public function login(){
        if(isset($_SESSION['user']) && $_SESSION['user']->connected)
            $this->render("index");
        else {
            if (isset(parameters()["action"]) &&  parameters()["action"] == "Se connecter") {
                $c = new T_E_CLIENT_CLI();
                $c->__set("cli_mel", trim(parameters()["login"]));
                $c->__set("cli_motpasse", parameters()["password"]);
                $c = $c->userExistInDb();

                if ($c == null) {
                    $messages = new message();
                    $messages->setFlash("Pseudo ou mot de passe inconnu");
                    $this->render("login");
                } else {
                    $_SESSION['user'] = $c;
                    $_SESSION['cart'] = array();
                    if($_SESSION['user']->role == "Service vente"){

                        header("Refresh:0; url=../Sprint/?r=srv");
                        
                    } elseif ($_SESSION['user']->role == "Service communication") {

                        header("Refresh:0; url=../Sprint/?r=src");

                    } elseif ($_SESSION['user']->role == "Service client") {

                         header("Refresh:0; url=../Sprint/?r=srl");
                    } else {

                        header("Refresh:0; url=../Sprint/?r=jeu");

                    }
                }

            } else {
                $this->render("login");
            }
        }
    }
    public function index(){
        $this->render("index");

    }
    public function unlog(){
        if(session_destroy()) {
            header("Refresh:0; url=../Sprint/");
            $c = new SiteController();
            $c ->index();
        }
        $m = new message();
        $m->setFlash("Deconnexion réussie","success");


    }
    public function modify(){
        if(!isset($_SESSION['user'])){
            $m = new message();
            $m->setFlash("Veuillez d'abord vous connecter");
            $this->render("login");
        }
        if(isset(parameters()["action"]) && parameters()["action"] == "Modifier son compte"){
            $this->render("modify");
        }
        if(isset(parameters()["action"]) && parameters()["action"] == "Modifier") {
            $mail = trim(parameters()["mel"]);
            $mdp = parameters()["motpasse"];
            $pseudo = parameters()["pseudo"];
            $civilite = parameters()["civilite"];
            $nom = strtoupper(parameters()["nom"]);
            $prenom = parameters()["prenom"];
            $tfixe = parameters()["telfixe"];
            $tport = parameters()["telportable"];

            $m = new message();

            $c = new T_E_CLIENT_CLI();
            $c = $_SESSION['user'];
            if(!($c->verifUserData($mail,$mdp,$mdp,$pseudo,$civilite,$nom,$prenom,$tfixe,$tport)))
            {
                $c->modifyInfo($mail,$mdp,$pseudo,$civilite,$nom,$prenom,$tfixe,$tport);
                $m->setFlash("Votre compte a bien été modifié","success");
                $this->render("index");
            } else {
                $this->render("modify");
            }

        }
    }
    public function removefromcart(){
        if(!isset($_SESSION['user'])) {
            header("Refresh:0; url=../Sprint/?r=cli/login");
            $m = new message();
            $m->setFlash('Vous devez etre connecté');
        } else {
            if(isset($_GET['jeu_id'])){
                $idGame = $_GET['jeu_id'];
                $m = new message();
                $game = new T_E_JEUVIDEO_JEU($idGame);
                if($game->jeu_id == null) {
                    echo "Ce jeu n'existe pas";
                } else {
                    if (in_array($game, $_SESSION['cart'])) {
                        $m->setFlash('Panier mis à jour', 'success');
                        $key = array_search($game, $_SESSION['cart']);
                        unset($_SESSION['cart'][$key]);

                    } else {
                        $m->setFlash('Cet article n\'est pas dans votre panier');
                    }
                }
            }
            header("Refresh:0; url=../Sprint/?r=cli/cart");
        }
    }
    public function cart(){
        if(!isset($_SESSION['user'])){
            header("Refresh:0; url=../Sprint/?r=cli/login");
            $m = new message();
            $m->setFlash('Vous devez etre connecté.');
        } else {
            $data = $_SESSION['cart'];
            $this->render("cart",$data);
        }
    }

    public function fav(){
        $m = new message();
        if(!isset($_SESSION['user'])){
            header("Refresh:0; url=../Sprint/?r=cli/login");
            $m = new message();
            $m->setFlash('Vous devez etre connecté.');
        } else {
            $favByCli = T_E_CLIENT_CLI::findFavById($_SESSION['user']->cli_id);
            if(!$favByCli){
                $m->setFlash("Vous n'avez aucun jeu favori.","warning");
                $this->render("fav");
            }
            else{
                foreach($favByCli as $fav){
                    $j = new T_E_JEUVIDEO_JEU($fav['jeu_id']);
                    $data[] = $j;
                }
                $this->render("fav", $data);
            }
        }
    }

    public function addToCart(){
        if(isset($_SESSION['user'])) {
            if (isset($_GET['jeu_id'])) {
                $id = $_GET['jeu_id'];
                $game = new T_E_JEUVIDEO_JEU($id);
                $gameAjax = false;
                if($game->jeu_id == null){
                    echo "Ce jeu n'existe pas !";
                } else {
                    if(in_array($game,$_SESSION['cart'])) {

                    } else {
                        $_SESSION['cart'][] = $game;
                        $gameAjax = true;
                    }
                }
                echo json_encode($gameAjax);
            }
        } else {
            header("Refresh:0; url=../Sprint/?r=cli/login");
            $m = new message();
            $m->setFlash('Vous devez etre connecté.');
        }
    }

    public function addToFav(){
        if(isset($_SESSION['user'])) {
            if (isset($_GET['jeu_id'])) {
                $id = $_GET['jeu_id'];
                $game = new T_E_JEUVIDEO_JEU($id);
                $gameAjax = false;
                if($game->jeu_id == null){
                    echo "Ce jeu n'existe pas !";
                } else {    
                        if(T_E_CLIENT_CLI::addToFav($id)){        
                            $gameAjax = true;
                        }
                    }
                echo json_encode($gameAjax);
            }
        } else {
            header("Refresh:0; url=../Sprint/?r=cli/login");
            $m = new message();
            $m->setFlash('Vous devez etre connecté.');
        }
        return $gameAjax;
    }

    public function delfav(){
        if(isset($_SESSION["user"]) && isset($_GET["id_game"])){
            T_E_CLIENT_CLI::delfav($_GET["id_game"]);
            header("Refresh:0; url=../Sprint/?r=cli/fav");
        }

    }





    public function register(){
        $m = new message();
        if(isset($_SESSION['user'])) {
            $this->render("index");
        } elseif(isset(parameters()["action"]) && parameters()["action"] == "S'inscrire"){
            $mail = trim(parameters()["mel"]);
            $mdp = parameters()["motpasse"];
            $mdpConf = parameters()["motpasseConfirm"];
            $pseudo = parameters()["pseudo"];
            $civilite = parameters()["civilite"];
            $nom = strtoupper(parameters()["nom"]);
            $prenom = parameters()["prenom"];
            $tfixe = parameters()["telfixe"];
            $tport = parameters()["telportable"];

            $client = new T_E_CLIENT_CLI();

            if(!$client->checkIfUserDontExist($mail,$pseudo)){
                $m->setFlash("Ce compte existe déja");
                $this->render("register");
            } else {
                $client->__set("cli_mel",$mail);
                $client->__set("cli_motpasse",$mdp);
                $client->__set("cli_pseudo",$pseudo);
                $client->__set("cli_civilite",$civilite);
                $client->__set("cli_nom",$nom);
                $client->__set("cli_prenom",$prenom);
                $client->__set("cli_telfixe",$tfixe);
                $client->__set("cli_telportable",$tport);
                if(!($client->verifUserData($mail,$mdp,$mdpConf,$pseudo,$civilite,$nom,$prenom,$tfixe,$tport)))
                {
                    $client->insertNewUser();
                     $m->setFlash($client->cli_prenom.", votre compte a bien été crée","success");
                    $this->render("login");
                } else {
                    $this->render("register");
                }
            }

        } else {
            $this->render("register");
        }
    }

    
    public function viewOne(){
        if(isset($_GET["id_cli"])){
            $id_cli = $_GET["id_cli"];
            $c = new T_E_CLIENT_CLIController();
            $c->render("displayById", T_E_CLIENT_CLI::findById($id_cli));
        }
    }

    public function adresse(){
        $data = null;
        if(isset($_SESSION['user'])):
            $adresse = new T_E_ADRESSE_ADR();
            if(isset(parameters()['InputNom']) && isset(parameters()['InputType']) && isset(parameters()['InputRue']) && isset(parameters()['InputComplementRue']) && isset(parameters()['InputCP']) && isset(parameters()['InputVille']) && isset(parameters()['InputPays'])) {
                $adresse->addAdresse($_SESSION['user']->cli_id,parameters()['InputNom'],parameters()['InputType'],parameters()['InputRue'],parameters()['InputComplementRue'],parameters()['InputCP'],parameters()['InputVille'],parameters()['InputPays']);
            }

            if(isset(parameters()['putfacturation'])){
                $adresse = new T_E_ADRESSE_ADR();
                $adresse->putFacturation($_SESSION['user']->cli_id,parameters()['putfacturation']);
            }

            if(isset(parameters()['delete'])){
                $adresse = new T_E_ADRESSE_ADR();
                $adresse->removeAdresse(parameters()['delete']);
            }

            $data['adresse'] = $adresse::findByClient($_SESSION['user']->cli_id);
            $data['pays'] = T_R_PAYS_PAY::findAll();
        endif;
        $this->render('adresse',$data);
    }

    public function orders()
    {
        $data = array();
        if(isset($_SESSION['user'])):
            $m = new message();

            $cli_id = $_SESSION['user']->cli_id;
            $c = T_E_COMMANDE_COM::findById($cli_id);

            if(count($c) < 1){
                $m->setFlash("Vous n'avez aucune commande.", "warning");
            }
            else{
                $data = array();
                foreach ($c as $key => $value) {
                    unset($d);
                    $d['commande'] = $value;
                    foreach (T_J_LIGNECOMMANDE_LEC::findAllProductforOneOrder($value->com_id) as $k => $v) {
                        $d['produit'][] = $v;
                    }
                    array_push($data, $d);
                }
            }
        endif;
        $this->render("orders", $data);
    }

    public function editAdresse(){
        $adresse = new T_E_ADRESSE_ADR();
        if(isset(parameters()['InputId']) && isset(parameters()['InputNom']) && isset(parameters()['InputRue']) && isset(parameters()['InputComplementRue']) && isset(parameters()['InputCP']) && isset(parameters()['InputVille']) && isset(parameters()['InputPays'])) {
            $adresse->editAdresse(parameters()['InputId'],parameters()['InputNom'],parameters()['InputRue'],parameters()['InputComplementRue'],parameters()['InputCP'],parameters()['InputVille'],parameters()['InputPays']);
        }

        $data['adresse'] = new T_E_ADRESSE_ADR(parameters()['adr_id']);
        $data['pays'] = T_R_PAYS_PAY::findAll();
        $this->render('editadresse',$data);
    }
}