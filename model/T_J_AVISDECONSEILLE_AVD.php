<?php

class T_J_AVISDECONSEILLE_AVD extends Model
{
    protected $_T_E_CLIENT_CLI;
    protected $_T_E_AVIS_AVI;

    public function saveAvisDecons($cliId, $avisId){
    	$req = db()->prepare("INSERT INTO t_j_avisdeconseille_avd (cli_id, avi_id) values (:cliId, :avisId)");
        $req->execute(array(
            "cliId" => $cliId,
            "avisId" => $avisId));

		$req = db()->prepare("delete from t_j_avisrecommande_avr where cli_id=:cliId and avi_id=:avisId");
		$req->execute(array(
			"cliId" => $cliId,
    		"avisId" => $avisId));
    }

    public static function getAvisDecons($avisId){
    	$st = db()->prepare("select count(*) from t_j_avisdeconseille_avd where avi_id=:avisId");
        $st->execute(array("avisId" => $avisId));

        return $st->fetch(PDO::FETCH_ASSOC)['count'];
    }
}