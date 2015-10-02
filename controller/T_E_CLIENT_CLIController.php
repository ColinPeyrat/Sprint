<?php


class T_E_CLIENT_CLIController extends Controller
{
    public function login(){
        if(isset($_SESSION['user']) && $_SESSION['user']->connected)
            $this->render("index");
        else {
            if (isset(parameters()["action"]) &&  parameters()["action"] == "Se Connecter") {
                $c = new T_E_CLIENT_CLI();
                $c->__set("cli_mel", parameters()["login"]);
                $c->__set("cli_motpasse", parameters()["password"]);
                $c = $c->userExistInDb();

                if ($c == null) {
                    $messages = new message();
                    $messages->setFlash("Pseudo ou mot de passe inconnu");
                    $this->render("login");
                } else {
                    $_SESSION['user'] = $c;
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
            header("Refresh:0; url=../sprint/");
            $c = new SiteController();
            $c ->index();
        }
        $m = new message();
        $m->setFlash("Deconnexion réussie","success");


    }
    public function modify(){
        if(isset(parameters()["action"]) && parameters()["action"] == "Modifier son compte"){
            $this->render("modify");
        }
        if(isset(parameters()["action"]) && parameters()["action"] == "Modifier") {
            $mail = parameters()["mel"];
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
            $c->modifyInfo($mail,$mdp,$pseudo,$civilite,$nom,$prenom,$tfixe,$tport);
            $m->setFlash("Votre compte a bien été modifié","success");
            $this->render("index");

        }
    }
    public function register(){
        $m = new message();
        if(isset($_SESSION['user'])) {
            $this->render("index");
        } elseif(isset(parameters()["action"]) && parameters()["action"] == "S'inscrire"){
            $mail = parameters()["mel"];
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
                }
                    $this->render("register");
            }

        } else {
            $this->render("register");
        }
    }
}