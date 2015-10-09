<?php

class T_E_AVIS_AVI extends Model
{
    protected $_avi_id;
    protected $_T_E_CLIENT_CLI;
    protected $_T_E_JEUVIDEO_JEU;
    protected $_avi_date;
    protected $_avi_titre;
    protected $_avi_detail;
    protected $_avi_note;


    public static function findByGame($id_game){
    	$class = get_called_class();
        $table = strtolower($class);
        $idtable = substr($table,-3)."_id";

        $list = array();
        foreach(T_E_AVIS_AVI::findAll() as $row){
            if($row->T_E_JEUVIDEO_JEU->jeu_id == $id_game){
                $list[] = new $class($row->avi_id, $row->T_E_JEUVIDEO_JEU->jeu_nom, $row->T_E_CLIENT_CLI->cli_pseudo, $row->avi_date, $row->avi_titre, $row->avi_note, $row->avi_detail);
            }
        }
        return $list;
    }
    public function deleteAvi(){
        $idAvis = $this->avi_id;
        $st = db()->prepare("DELETE FROM T_E_AVIS_AVI WHERE avi_id=:avi");
        $st->bindParam(':avi', $idAvis);
        $st->execute();
    }
    public function deleteAllAva(){
        $id = $this->avi_id;
//        $st = db()->prepare("DELETE FROM T_E_AVIS_AVI WHERE avi_id=:avi");
        $allAvas = T_J_AVISABUSIF_AVA::FindAllByIdAvis($id);
        foreach ($allAvas as $ava) {
            $idAva = $ava->T_E_AVIS_AVI->avi_id;
            $st = db()->prepare("DELETE FROM T_J_AVISABUSIF_AVA WHERE avi_id=:avi");
            $st->bindParam(':avi', $idAva);
            $st->execute();

        }
        $avi = new T_E_AVIS_AVI($id);
        $avi->deleteAvi();

//        $st->bindParam(':avi', $id);
//        $st->execute();
    }
}