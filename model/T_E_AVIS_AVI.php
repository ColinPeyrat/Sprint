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
}