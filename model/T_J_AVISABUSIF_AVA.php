<?php

class T_J_AVISABUSIF_AVA extends Model
{
    protected $_T_E_CLIENT_CLI;
    protected $_T_E_AVIS_AVI;

    public function __construct($id=null,$idUser=null,$idAvis=null) {
        if ($id == null) {
            $st = db()->prepare("INSERT INTO T_J_AVISABUSIF_AVA (cli_id, avi_id) VALUES (:cli, :avi)");
            $st->bindParam(':cli', $idUser);
            $st->bindParam(':avi', $idAvis);
            $st->execute();

//            $st = db()->prepare("insert into T_J_AVISABUSIF_AVA default values returning avi_id");
//            $st->execute();
//            $row = $st->fetch();
//            $this->avi_id = $row['avi_id'];
//            var_dump($row);
            if($idUser != null && $idAvis != null){
                $this->T_E_CLIENT_CLI = $idUser;
                $this->T_E_AVIS_AVI = $idAvis;
            }

        } else {
            $st = db()->prepare("select * from T_J_AVISABUSIF_AVA where avi_id=:id");
            $st->bindParam(':id', $id);
            $st->execute();
            $list = array();
            while($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $user = new T_E_CLIENT_CLI($row['cli_id']);
                $avis = new T_E_AVIS_AVI($id);
                $list[] = new T_J_AVISABUSIF_AVA('null',new T_E_CLIENT_CLI($row['cli_id']),new T_E_AVIS_AVI($id));


            }
            var_dump($list);
        }

    }
//    public static function findAll() {
//        $st = db()->prepare("select * from T_J_AVISABUSIF_AVA");
//        $st->execute();
//        $list = array();
//        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
//            $list[] = new T_J_AVISABUSIF_AVA($row['avi_id']);
//        }
//        var_dump($list);
//        return $list;
//    }
}