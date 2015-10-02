<?php

class T_E_JEUVIDEO_JEUController extends Controller
{
    public function index() {
        $this->render("index", T_E_JEUVIDEO_JEU::findAll());
    }

    public function findBySelection(){
    	if(isset($_POST["id_console"])){
    		$id_console = $_POST["id_console"];
    		$this->render("displaySelection", T_E_JEUVIDEO_JEU::findBySelection($id_console));
    	}
    	else{
    		$this->render("find");
    	}
    }
}