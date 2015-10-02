<?php

class T_E_JEUVIDEO_JEUController extends Controller
{
    public function index() {
    	if(isset($_POST['searchbtn'])){
			if($_POST['searchbtn'] == 'search'){
				if($_POST['typesearch'] != 'tous'){
					$a = new T_J_JEURAYON_JER();
					$games = $a->findGameByRay($_POST['typesearch']);
					$this->render("index", [T_E_JEUVIDEO_JEU::findAll(), T_R_RAYON_RAY::findall(), $games]);
				}
			}
		}

        $this->render("index", [T_E_JEUVIDEO_JEU::findAll(), T_R_RAYON_RAY::findall()]);
    }
}