<?php 

class T_E_AVIS_AVIController extends Controller
{
	public function findByGame(){
	    if(isset($_GET["id_game"])){
	    	$id_game = $_GET["id_game"];
	    	
	    	$this->render("displayByGame", T_E_AVIS_AVI::findByGame($id_game));
	    }
	}
}