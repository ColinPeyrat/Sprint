<?php


class SERVICE_COMMUNICATIONController extends Controller
{
    public function index(){
        $this->render("index");
    }
    public function ava(){
        $this->render("ava",T_J_AVISABUSIF_AVA::findAll());
    }
    public function removeavi(){
        if(isset($_GET['avi_id'])){
            $id = $_GET['avi_id'];
            $avis = new T_E_AVIS_AVI($id);
            if($avis->avi_id == null){
                $m = new message();
                $m->setFlash("Cet avis n'existe pas");
                header("Refresh:0; url=../Sprint/?r=src");
            } else {
                $avis->deleteAllAva();
                $m = new message();
                $m->setFlash("L'avis a bien été supprimé","success");
                header("Refresh:0; url=../Sprint/?r=src");

            }
        }
    }
    public function removeava(){

        if(isset($_GET['avi_id']) && isset($_GET['cli_id'])){
            $idAvis = $_GET['avi_id'];
            $idUser = $_GET['cli_id'];
            $st = db()->prepare("DELETE FROM T_J_AVISABUSIF_AVA WHERE avi_id=:avi and cli_id=:cli");
            $st->bindParam(':avi', $idAvis);
            $st->bindParam(':cli', $idUser);
            $st->execute();
            $m = new message();
            $m->setFlash("L'avis abusif a été ignoré","success");
            header("Refresh:0; url=../Sprint/?r=src");


//            $id = $_GET['avi_id'];
//            $avis = new T_E_AVIS_AVI($id);
//            if($avis->avi_id == null){
//                $m = new message();
//                $m->setFlash("Cet avis n'existe pas");
//                header("Refresh:0; url=../Sprint/?r=src");
//            } else {
//                $avis->deleteAllAva();
//                $m = new message();
//                $m->setFlash("l'avis a bien été supprimé","success");
//                header("Refresh:0; url=../Sprint/?r=src");
//
//            }
        }
    }

}
