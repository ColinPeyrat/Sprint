<?php

class T_E_JEUVIDEO_JEUController extends Controller
{
    public function index() {
        $j = new T_J_JEURAYON_JER();

    	if(isset($_POST['searchbtn'])){
			if($_POST['searchbtn'] == 'search'){
                $games = $j->findGameByRay($_POST['typesearch'], $_POST['searchinput']);
            }
        }
        else
            $games = $j->findGameByRay('tous', "");
				
        if(Count($games)>0){
        	$this->render("index", [$games, T_R_RAYON_RAY::findall()]);
        } else {
            $m = new message();
            $m->setFlash("Aucun résuiltat pour cette recherche.","warning");
            $this->render("index", [$games, T_R_RAYON_RAY::findall()]);
        }	
    }

    public function findBySelection(){
    	if(isset($_POST["id_console"])){
    		$id_console = $_POST["id_console"];
            $data = T_E_JEUVIDEO_JEU::findBySelection($id_console);
            if($data == null){
                $m = new message();
                $m->setFlash("Aucun résultat pour cette recherche.","warning");
            }
    		$this->render("find", T_E_JEUVIDEO_JEU::findBySelection($id_console));
    	}
    	else{
    		$this->render("find");
    	}
    }
    public function displayById(){
        if(isset($_GET["jeu_id"])){
            $idGame = $_GET["jeu_id"];
            $idGame;
            $game = new T_E_JEUVIDEO_JEU($idGame);
            $photo = T_E_PHOTO_PHO::findByGame($idGame);
            $movie = T_E_VIDEO_VID::findByGame($idGame);
            $advice = T_E_AVIS_AVI::findByGame($idGame);
            $this->render('displayById',array($game,$photo,$movie,$advice));
        }
        else{
            $this->render("find");
        }
    }
}