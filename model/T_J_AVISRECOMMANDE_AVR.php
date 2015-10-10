<?php

class T_J_AVISRECOMMANDE_AVR extends Model
{
    protected $_T_E_CLIENT_CLI;
    protected $_T_E_AVIS_AVI;

    public function saveAvisRecommande($cliId, $avisId){
    	$req = db()->prepare("INSERT INTO t_j_avisrecommande_avr (cli_id, avi_id) values (:cliId, :avisId)");
        $req->execute(array(
            "cliId" => $cliId,
            "avisId" => $avisId));     	

		$req = db()->prepare("delete from t_j_avisdeconseille_avd where cli_id=:cliId and avi_id=:avisId");
		$req->execute(array(
			"cliId" => $cliId,
            "avisId" => $avisId));
    }

    public static function getAvisRecommande($avisId){
    	$st = db()->prepare("select count(*) from t_j_avisrecommande_avr where avi_id=:avisId");
        $st->execute(array("avisId" => $avisId));

        return $st->fetch(PDO::FETCH_ASSOC)['count'];
    }
}