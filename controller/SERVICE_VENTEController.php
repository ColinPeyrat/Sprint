<?php


class SERVICE_VENTEController extends Controller
{
	public function index(){
		$this->render("index");
	}

	public function gallery(){
        $j = T_E_JEUVIDEO_JEU::findAll();
        $p = T_E_PHOTO_PHO::findAll();
        $m = T_E_VIDEO_VID::findAll();

        $listj = array();
        foreach($j as $k => $v){
            unset($list);
            $list['nom'] = $v->jeu_nom;
            foreach($p as $x => $y){
                if($y->T_E_JEUVIDEO_JEU->jeu_id == $v->jeu_id){
                    $list['pho_url'][] = $y->pho_url;
                }
            }
            foreach($m as $x => $y){
                if($y->T_E_JEUVIDEO_JEU->jeu_id == $v->jeu_id){
                    $list['vid_url'][] = $y->vid_url;
                }
            }
            array_push($listj,$list);
        }

        $this->render("gallery",$listj);
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
                            $photo = new T_E_PHOTO_PHO();
							$photo->addPhoto(parameters()["jeu"],TARGET.$nomImage);
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
        $m = new message();
		if (isset(parameters()["input"])) {
            if(preg_match('/youtube/',parameters()['input'])){
                $video = new T_E_VIDEO_VID();
                $videos = $video->findByGame(parameters()['jeu']);
                if(count($videos) != 0){
                    $m->setFlash("Il y a déjà une video pour ce jeu");
                }
                else{
                    preg_match(
                        '/[\\?\\&]v=([^\\?\\&]+)/',
                        parameters()['input'],
                        $matches
                    );
                    $video->addVideo(parameters()['jeu'],'https://www.youtube.com/embed/'.$matches[1].'?rel=0&showinfo=0&color=white&iv_load_policy=3');
                }
            }
            else{
                $m->setFlash("Ce n'est pas une url de youtube");
            }
		}
        $this->render("addvideo", T_E_JEUVIDEO_JEU::findAll());
	}
}