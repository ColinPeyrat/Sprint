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
            $m->setFlash("Votre compte a bien été modifier","success");
            $this->render("index");

        }
    }
}