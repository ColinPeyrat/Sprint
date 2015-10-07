<?php

class T_E_PHOTO_PHO extends Model
{
    protected $_pho_id;
    protected $_T_E_JEUVIDEO_JEU;
    protected $_pho_url;


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