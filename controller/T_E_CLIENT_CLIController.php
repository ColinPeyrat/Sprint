<?php


class T_E_CLIENT_CLIController extends Controller
{
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
                    $this->render("index");
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
            $m->setFlash('Vous devez etre connecté');
        } else {
            $data = $_SESSION['cart'];
            $this->render("cart",$data);
        }
    }

    public function addToCart(){
        if(isset($_SESSION['user'])) {
            if (isset($_GET['jeu_id'])) {
                $id = $_GET['jeu_id'];
                $game = new T_E_JEUVIDEO_JEU($id);
                $gameAjax = false;
                if($game->jeu_id == null){
                    echo "Ce jeu n'existe pas";
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
            $m->setFlash('Vous devez etre connecté');
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
}