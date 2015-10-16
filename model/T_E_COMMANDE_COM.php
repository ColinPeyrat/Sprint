<?php

class T_E_COMMANDE_COM extends Model
{
    protected $_com_id;
    protected $_T_E_RELAIS_REL;
    protected $_T_E_ADRESSE_ADR;
    protected $_T_E_CLIENT_CLI;
    protected $_com_date;
	
	public static function findByDate($date){
        $c = T_E_COMMANDE_COM::findAll();

        $commande = array();
        foreach($c as $k => $v){
            if($v->com_date == $date){
                array_push($commande,$v);
            }
        }
        return $commande;
    }

    public static function ordersByClient(){
        echo "ok classe";
    }
}