<?php

class T_J_LIGNECOMMANDE_LEC extends Model
{
    protected $_T_E_COMMANDE_COM;
    protected $_T_E_JEUVIDEO_JEU;
    protected $_lec_quantite;

    public function __construct($com_id,$jeu_id){
        $st = db()->prepare("select lec_quantite from T_J_LIGNECOMMANDE_LEC  where com_id=:com_id and jeu_id=:jeu_id");
        $st->bindValue(":com_id", $com_id);
        $st->bindValue(":jeu_id", $jeu_id);
        $st->execute();

        if ($st->rowCount() != 1) {
            throw new Exception("Not in table: T_E_COMMANDE_COM com_id:".$com_id." jeu_id:".$jeu_id);
        } else {
            $row = $st->fetch(PDO::FETCH_ASSOC);
            foreach($row as $field=>$value){
                $this->_T_E_COMMANDE_COM = new T_E_COMMANDE_COM($com_id);
                $this->_T_E_JEUVIDEO_JEU = new T_E_JEUVIDEO_JEU($jeu_id);
                $this->_lec_quantite = $value;
            }
        }
    }

    public static function findAll(){
        $st = db()->prepare("select * from T_J_LIGNECOMMANDE_LEC");
        $st->execute();
        $list = array();
        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new T_J_LIGNECOMMANDE_LEC($row['com_id'],$row['jeu_id']);
        }
        return $list;
    }

    public static function findAllProductforOneOrder($id){
        $o = T_J_LIGNECOMMANDE_LEC::findAll();
        $list = array();
        foreach($o as $k=>$v){
            if($v->T_E_COMMANDE_COM->com_id == $id)
                $list[] = $v;
        }
        return $list;
    }
}