<?php

class T_E_VIDEO_VID extends Model
{
    protected $_vid_id;
    protected $_T_E_JEUVIDEO_JEU;
    protected $_vid_url;

    public static function addVideo($jeu_id,$vid_url){
        $st = db()->prepare("insert into t_e_video_vid(jeu_id,vid_url) values(".$jeu_id.",'".$vid_url."')");
        $st->execute();
        $m = new message();
        $m->setFlash("Upload réussi","success");
    }

    public static function findByGame($id_game){
        $class = get_called_class();
        $list = array();
        foreach($class::findAll() as $row){
            if($row->T_E_JEUVIDEO_JEU->jeu_id == $id_game){
                $list[] = new $class($row->vid_id);
            }
        }
        return $list;
    }
}