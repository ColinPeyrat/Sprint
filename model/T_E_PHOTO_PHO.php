<?php

class T_E_PHOTO_PHO extends Model
{
    protected $_pho_id;
    protected $_T_E_JEUVIDEO_JEU;
    protected $_pho_url;

    public static function addPhoto($jeu_id,$pho_url){
        $st = db()->prepare("insert into t_e_photo_pho(jeu_id,pho_url) values(".$jeu_id.",'".$pho_url."')");
        $st->execute();
        $m = new message();
        $m->setFlash("Upload réussi","success");
    }

    public static function findByGame($id_game){
    	$class = get_called_class();
        $table = strtolower($class);
        $idtable = substr($table,-3)."_id";

        $list = array();
        foreach(T_E_PHOTO_PHO::findAll() as $row){
            if($row->T_E_JEUVIDEO_JEU->jeu_id == $id_game){
                $list[] = new $class($row->pho_id, $row->T_E_JEUVIDEO_JEU, $row->pho_url);
            }
        }
        return $list;
    }
}