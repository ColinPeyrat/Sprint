<?php

class T_J_RELAISCLIENT_REC extends Model
{
    protected $_T_E_CLIENT_CLI;
    protected $_T_E_RELAIS_REL;

    public function __construct($cli_id,$rel_id){
                $this->_T_E_CLIENT_CLI = new T_E_CLIENT_CLI($cli_id);
                $this->_T_E_RELAIS_REL = new T_E_RELAIS_REL($rel_id);
            }



    public static function findAll(){
        $st = db()->prepare("select * from T_J_RELAISCLIENT_REC");
        $st->execute();
        $list = array();
        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new T_J_RELAISCLIENT_REC($row['cli_id'],$row['rel_id']);
        }
        return $list;
    }

    public static function findByIdClient($idClient){
        if(isset($idClient) && !empty($idClient)){
            $allRelayClient = T_J_RELAISCLIENT_REC::findAll();
            $list = array();
            foreach($allRelayClient as $key=>$relay){
                if($relay->T_E_CLIENT_CLI->cli_id == $idClient)
                    $list[] = $relay;
            }
            return $list;
        }
    }
    public static function checkIfRelayClientAlreadyExist($idClient,$idRelay){
        if(isset($idClient) && isset($idRelay) && !empty($idClient)&& !empty($idRelay)) {
            $allRelayClient = T_J_RELAISCLIENT_REC::findAll();
            $error = false;
            foreach($allRelayClient as $key=>$relay){
                if($relay->T_E_CLIENT_CLI->cli_id == $idClient && $relay->T_E_RELAIS_REL->rel_id == $idRelay){
                    $error = true;
                }
            }
            return $error;
        }
    }
    public static function addRelayClient($idClient,$idRelay){
        if(isset($idClient) && isset($idRelay) && !empty($idClient)&& !empty($idRelay)) {
                $st = db()->prepare("INSERT INTO T_J_RELAISCLIENT_REC(cli_id,rel_id) VALUES (:cli, :rel)");
                $st->bindParam(':cli', $idClient);
                $st->bindParam(':rel', $idRelay);
                $st->execute();
        }
    }
}