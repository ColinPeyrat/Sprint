<?php

class T_E_JEUVIDEO_JEUController extends Controller
{
    public function index() {
    	if(isset($_POST['searchbtn'])){
			if($_POST['searchbtn'] == 'search'){
				$a = new T_J_JEURAYON_JER();
				$games = $a->findGameByRay($_POST['typesearch'], $_POST['searchinput']);
				$this->render("index", [T_E_JEUVIDEO_JEU::findAll(), T_R_RAYON_RAY::findall(), $games]);
			}
		}

        $this->render("index", [T_E_JEUVIDEO_JEU::findAll(), T_R_RAYON_RAY::findall()]);
    }
}