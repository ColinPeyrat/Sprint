<?php

class T_J_AVISABUSIF_AVA extends Model
{
    protected $_T_E_CLIENT_CLI;
    protected $_T_E_AVIS_AVI;

    public function __construct($id=null,$idUser=null,$idAvis=null) {
        if ($id == null) {
            if($idUser != null && $idAvis != null) {
                $st = db()->prepare("select * from T_J_AVISABUSIF_AVA where avi_id=:id and cli_id=:cli");
                $st->bindParam(':id', $idAvis);
                $st->bindParam(':cli', $idUser);
                $st->execute();
                $row = $st->fetch(PDO::FETCH_ASSOC);
                if($row){
                    $this->T_E_AVIS_AVI = new T_E_AVIS_AVI($row['avi_id']);
                    $this->T_E_CLIENT_CLI = new T_E_CLIENT_CLI($row['cli_id']);
                } else {

                }
            } else {
                $st = db()->prepare("INSERT INTO T_J_AVISABUSIF_AVA (cli_id, avi_id) VALUES (:cli, :avi)");
                $st->bindParam(':cli', $idUser);
                $st->bindParam(':avi', $idAvis);
                $st->execute();
            }



        } else {


        }

    }
    public static function findAll() {
        $st = db()->prepare("select * from T_J_AVISABUSIF_AVA");
        $st->execute();
        $list = array();
        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new T_J_AVISABUSIF_AVA(null,$row['cli_id'],$row['avi_id']);
        }
        return $list;
    }
    public static function insertNewAva($idAvi,$idUser){
        $st = db()->prepare("INSERT INTO T_J_AVISABUSIF_AVA(cli_id,avi_id) VALUES (:cli, :avi)");
        $st->bindParam(':cli', $idUser);
        $st->bindParam(':avi', $idAvi);
        $st->execute();
    }
    public static function FindAllByIdAvis($id){
        $st = db()->prepare("select * from T_J_AVISABUSIF_AVA where avi_id=:id");
        $st->bindParam(':id', $id);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        $test = array();
        foreach($row as $field=>$value) {
            $ava = new T_J_AVISABUSIF_AVA(null,$value['cli_id'],$value['avi_id']);
            $test[] = $ava;
        }
        return $test;
    }
    public function __set($fieldName, $value) {
        $varName = "_".$fieldName;
        if ($value != null) {
            if (property_exists(get_class($this), $varName)) {
                $this->$varName = $value;

            } else
                throw new Exception("Unknown variable: ".$fieldName);
        }
    }
}