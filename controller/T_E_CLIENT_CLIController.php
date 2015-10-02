<?php


class T_E_CLIENT_CLIController extends Controller
{
    public function login(){
        if(isset($_SESSION['user']) && $_SESSION['user']->connected)
            $this->render("index");
        else {
            if (isset(parameters()["action"]) &&  parameters()["action"] == "Se Connecter") {
                $c = new T_E_CLIENT_CLI();
                $c->__set("cli_pseudo", parameters()["login"]);
                $c->__set("cli_motpasse", parameters()["password"]);
                $c->userExistInDb();
                if ($c->connected) {
                    $_SESSION['user'] = $c;
                    $this->render("index");
                } else {
                    $messages = new message();
                    $messages->setFlash("Pseudo ou mot de passe inconnu");
                    $this->render("login");
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
}