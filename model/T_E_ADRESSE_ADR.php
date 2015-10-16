<?php

class T_E_ADRESSE_ADR extends Model
{
    protected $_adr_id;
    protected $_T_E_CLIENT_CLI;
    protected $_adr_nom;
    protected $_adr_type;
    protected $_adr_rue;
    protected $_adr_complementrue;
    protected $_adr_cp;
    protected $_adr_ville;
    protected $_T_R_PAYS_PAY;
    protected $_adr_latitude;
    protected $_adr_longitude;

    public static function findByClient($id_client){
        $class = get_called_class();
        $list = array();
        foreach($class::findAll() as $row){
            if($row->T_E_CLIENT_CLI->cli_id == $id_client){
                $list[] = new $class($row->adr_id);
            }
        }
        return $list;
    }

    public static  function putFacturation($userid,$idfacturation){
        $adresse = new T_E_ADRESSE_ADR();
        $data = $adresse::findByClient($userid);

        foreach($data as $k=>$v){
            $adr = new T_E_ADRESSE_ADR($v->adr_id);
            if($v->adr_id != $idfacturation)
                $adr->__set('adr_type','Livraison');
            else
                $adr->__set('adr_type','Facturation');
        }
    }

    public static function addAdresse($cli_id,$adr_nom,$adr_type,$adr_rue,$adr_complementrue,$adr_cp,$adr_ville,$pay_id){
        $m = new message();
        $adresse = new T_E_ADRESSE_ADR();
        if(!empty($adr_nom) && !empty($adr_type) && !empty($adr_rue) && !empty($adr_cp) && !empty($adr_ville) && !empty($pay_id)){
            $st = db()->prepare("insert into t_e_adresse_adr(cli_id,adr_nom,adr_type,adr_rue,adr_complementrue,adr_cp,adr_ville,pay_id) values(".$cli_id.",'".$adr_nom."','".$adr_type."','".$adr_rue."','".$adr_complementrue."','".$adr_cp."','".$adr_ville."',".$pay_id.") returning adr_id");
            $st->execute();
            $m->setFlash("L'addresse à été ajouter","success");

            if($adr_type == 'Facturation'){
                $adr_id = $st->fetch();
                $adresse->putFacturation($cli_id,$adr_id['adr_id']);
            }
            unset($_POST['InputNom']);
            unset($_POST['InputType']);
            unset($_POST['InputRue']);
            unset($_POST['InputComplementRue']);
            unset($_POST['InputCP']);
            unset($_POST['InputVille']);
            unset($_POST['InputPays']);
        }
        else{
            $m->setFlash("Tous les champs doivent être remplis");
        }
    }

    public static function removeAdresse($id_adresse){
        $st = db()->prepare("delete from t_e_adresse_adr where adr_id=$id_adresse");
        $st->execute();
    }
}