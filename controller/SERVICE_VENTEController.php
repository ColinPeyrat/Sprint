<?php


class SERVICE_VENTEController extends Controller
{
	public function index(){
		$this->render("index");
	}

	public function addphoto(){
		if (isset(parameters()["input"]['name'])) {
			define('TARGET', './input/');
            define('MAX_SIZE', 5000000);
			$tabExt = array('jpg', 'png','jpeg');
			$extension  = pathinfo($_FILES['input']['name'], PATHINFO_EXTENSION);

			if(in_array(strtolower($extension),$tabExt)){

                if(filesize($_FILES['input']['tmp_name']) <= MAX_SIZE) {

                    if(isset($_FILES['input']['error']) && UPLOAD_ERR_OK === $_FILES['input']['error']){
                        $nomImage = md5(uniqid()) .'.'. $extension;

                        if(@move_uploaded_file($_FILES['input']['tmp_name'], TARGET.$nomImage))
                        {
                            $st = db()->prepare("insert into t_e_photo_pho(jeu_id,pho_url) values(".parameters()["jeu"].",'".TARGET.$nomImage."')");
                            $st->execute();
                            $m = new message();
                            $m->setFlash("Upload réussi","success");
                        }
                        else
                        {
                            $m = new message();
                            $m->setFlash("Problème lors de l'upload !");
                        }
                    }
                    else{
                        $m = new message();
                        $m->setFlash("Erreur interne");
                    }
                }
                else{
                    $m = new message();
                    $m->setFlash("Taille de fichier trop importante");
                }
			}
			else{
				$m = new message();
		        $m->setFlash("Erreur d'extension");
			}
		}
        $this->render("addphoto", T_E_JEUVIDEO_JEU::findAll());
	}

	public function addvideo(){
		if (isset(parameters()["input"]['name'])) {
			define('TARGET', './input/');
			define('MAX_SIZE', 5000000);
			$tabExt = array('mp4', 'avi','wma');
			$extension  = pathinfo($_FILES['input']['name'], PATHINFO_EXTENSION);

			if(in_array(strtolower($extension),$tabExt)){
				if(filesize($_FILES['input']['tmp_name']) <= MAX_SIZE) {
					if(isset($_FILES['input']['error']) && UPLOAD_ERR_OK === $_FILES['input']['error']){
						$nomvideo = md5(uniqid()) .'.'. $extension;

						if(@move_uploaded_file($_FILES['input']['tmp_name'], TARGET.$nomvideo))
						{
							$st = db()->prepare("insert into t_e_photo_pho(jeu_id,vid_url) values(".parameters()["jeu"].",'".TARGET.$nomvideo."')");
							$st->execute();
							$m = new message();
							$m->setFlash("Upload réussi","success");
						}
						else
						{
							$m = new message();
							$m->setFlash("Problème lors de l'upload !");
						}
					}
					else{
						$m = new message();
						$m->setFlash("Erreur interne");
					}
				}
				else{
					$m = new message();
					$m->setFlash("Taille de fichier trop importante");
				}
			}
			else{
				$m = new message();
		        $m->setFlash("Erreur d'extension");
			}
		}
        $this->render("addvideo", T_E_JEUVIDEO_JEU::findAll());
	}
}