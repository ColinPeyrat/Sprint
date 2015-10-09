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
        $m = new message();
    	$class = get_called_class();
        $table = strtolower($class);
        $idtable = substr($table,-3)."_id";

        $list = array();
        $empty = null;
        $return = null;
        foreach(T_E_AVIS_AVI::findAll() as $row){
            if($row->T_E_JEUVIDEO_JEU->jeu_id == $id_game){
                $list[] = new $class($row->avi_id);
                $return = $list;
            }
            else  { 
                $empty = $id_game; 
                $return = $empty;
                $m->setFlash("Il n'y a aucun avis pour ce jeu.","warning");
            }
        }
        return $return;
    }

    public function add(){
        $req = db()->prepare("INSERT INTO t_e_avis_avi (cli_id, jeu_id, avi_date, avi_titre, avi_detail, avi_note) VALUES (:id_client, :id_game, now(), :titre, :detail, :note)");
        $req->execute(array(
            "id_client" => $this->_T_E_CLIENT_CLI->cli_id,
            "id_game" => $this->_T_E_JEUVIDEO_JEU->jeu_id,
            "titre" => $this->_avi_titre,
            "detail" => $this->_avi_detail,
            "note" => $this->_avi_note
            ));
    }
}