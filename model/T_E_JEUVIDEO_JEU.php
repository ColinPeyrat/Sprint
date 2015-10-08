<?php

class T_E_JEUVIDEO_JEU extends Model
{
    protected $_jeu_id;
    protected $_T_R_EDITEUR_EDI;
    protected $_T_R_CONSOLE_CON;
    protected $_jeu_nom;
    protected $_jeu_description;
    protected $_jeu_dateparution;
    protected $_jeu_prixttc;
    protected $_jeu_codebarre;
    protected $_jeu_publiclegal;
    protected $_jeu_stock;

    protected $_photo;


    public static function findBySelection($id_console){
        $class = get_called_class();
        $table = strtolower($class);
        $idtable = substr($table,-3)."_id";

        $list = array();
        foreach(T_E_JEUVIDEO_JEU::findAll() as $row){
            if($row->T_R_CONSOLE_CON->con_id == $id_console){
                $game = new T_E_JEUVIDEO_JEU($row->jeu_id);
                foreach (T_E_PHOTO_PHO::findByGame($row->jeu_id) as $key => $value) {
                    $game->photo = $value->pho_url;
                    break;
                }
                $list[] = $game;
        }


        }
        return $list;
    }
}