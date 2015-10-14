<?php 

class T_E_AVIS_AVIController extends Controller
{
	public function findByGame(){
	    if(isset($_GET["id_game"])){
	    	$id_game = $_GET["id_game"];
            $data = T_E_AVIS_AVI::findByGame($id_game);
            if(count($data)>0){
	    	  $this->render("displayByGame", $data);
            } else {
                $m = new message();
                $m->setFlash("Aucun avis pour ce jeu.","warning");
                $this->render("displayByGame", $id_game);
            }
	    }
	}


	public function add(){
        $m = new message();
    	if(isset($_POST["addbtn"]) && $_POST["addbtn"] == "Ajouter"){
            if(empty($_POST["titre"]) || empty($_POST["detail"])){
                $m = new message();
                $m->setFlash("Tous les champs doivent être remplis."); 
            }
            else {

                $avi = new T_E_AVIS_AVI();
                $client = new T_E_CLIENT_CLI($_GET['id_client']);
                $jeu = new T_E_JEUVIDEO_JEU($_GET['id_game']);

                $avi->__set("T_E_CLIENT_CLI",$client);
                $avi->__set("T_E_JEUVIDEO_JEU",$jeu);
                $avi->__set("avi_titre",$_POST["titre"]);
                $avi->__set("avi_detail",$_POST["detail"]);
                $avi->__set("avi_note",$_POST["note"]);

                $avi->add();
                $m->setFlash($client->cli_prenom.", votre avis a bien été déposé.","success");
                $this->render("displayByGame",T_E_AVIS_AVI::findByGame($jeu->jeu_id));
            }
        } else {

                
        if(isset($_SESSION['user']))
    	   $this->render("add");
        else {
            $m = new message();
            $m->setFlash("Vous devez etre connecté.");
            header('refresh:0;url=../Sprint/?r=cli/login');
        }
    }
    }

	public function signal(){
		if(isset($_GET['id_avi'])){
			if(!isset($_SESSION['user'])){
				$m = new message();
				$m->setFlash("Vous devez etre connecté pour signaler un commentaire");
				$c = new T_E_CLIENT_CLIController();
				$c->render("login");
			} else {

					$allAvas = T_J_AVISABUSIF_AVA::FindAllByIdAvis($_GET['id_avi']);
					$alreadySignal = false;
					foreach ($allAvas as $ava) {
						if($ava->T_E_CLIENT_CLI->cli_id == $_SESSION['user']->cli_id){
							$alreadySignal = true;
						}
					}


				if($alreadySignal){
					$m = new message();
					$m->setFlash("Vous avez déja signaler ce commentaire, merci d'attendre que le service vente prenne en compte votre requête");

					header("Refresh:0; url=../Sprint/?r=jeu");
				} else {
					T_J_AVISABUSIF_AVA::insertNewAva($_GET['id_avi'],$_SESSION['user']->cli_id);
                    $m = new message();
                    $m->setFlash("Le commentaire a bien été signalé",'success');

					header("Refresh:0; url=../Sprint/?r=jeu");
                }
			}


		}
	}

    public function saveLike(){
        if(isset($_SESSION['user'])){
            if($_POST['type'] == 'like'){
                $a = new T_J_AVISRECOMMANDE_AVR();
                $a->saveAvisRecommande($_SESSION['user']->cli_id, $_POST['avisId']);
            }
            else{
                $a = new T_J_AVISDECONSEILLE_AVD();
                echo $a->saveAvisDecons($_SESSION['user']->cli_id, $_POST['avisId']);
            }
        }
        echo T_J_AVISRECOMMANDE_AVR::getAvisRecommande($_POST['avisId']).'/'.T_J_AVISDECONSEILLE_AVD::getAvisDecons($_POST['avisId']);
    }
}