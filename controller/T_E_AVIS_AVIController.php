<?php 

class T_E_AVIS_AVIController extends Controller
{
	public function findByGame(){
	    if(isset($_GET["id_game"])){
	    	$id_game = $_GET["id_game"];
	    	
	    	$this->render("displayByGame", T_E_AVIS_AVI::findByGame($id_game));
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
}