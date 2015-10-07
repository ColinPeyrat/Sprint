<?php

class T_E_JEUVIDEO_JEUController extends Controller
{
    public function index() {
    	if(isset($_POST['searchbtn'])){
			if($_POST['searchbtn'] == 'search'){
				$j = new T_J_JEURAYON_JER();
				$games = $j->findGameByRay($_POST['typesearch'], $_POST['searchinput']);
                if(Count($games)>0){
                	$this->render("index", [T_E_JEUVIDEO_JEU::findAll(), T_R_RAYON_RAY::findall(), $games]);
                } else {
                    $m = new message();
                    $m->setFlash("Aucun résuiltat pour cette recherche.");
                    $this->render("index", [T_E_JEUVIDEO_JEU::findAll(), T_R_RAYON_RAY::findall(), $games]);
                }
			}
		}

        $this->render("index", [T_E_JEUVIDEO_JEU::findAll(), T_R_RAYON_RAY::findall()]);
    }

    public function findBySelection(){
    	if(isset($_POST["id_console"])){
    		$id_console = $_POST["id_console"];
    		$this->render("find", T_E_JEUVIDEO_JEU::findBySelection($id_console));
    	}
    	else{
    		$this->render("find");
    	}
    }
}