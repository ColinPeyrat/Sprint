<?php

class T_J_JEURAYON_JER extends Model
{
    protected $_T_E_JEUVIDEO_JEU;
    protected $_T_R_RAYON_RAY;


    public function findGameByRay($id, $name)
    {
        $st = db()->prepare("select * from t_e_jeuvideo_jeu where jeu_id in (select jeu_id from t_j_jeurayon_jer where ray_id=:rayid) and lower(jeu_nom) like lower(:name)");
        $st->bindValue(":rayid", $id);
        $st->bindValue(":name", "%$name%");
        $st->execute();
        
        $games = array();
        if ($st->rowCount() >= 1){
			while($row = $st->fetch(PDO::FETCH_ASSOC)) {
				$games[] = new T_E_JEUVIDEO_JEU($row['jeu_id']);
			}
        }
        return $games;
    }
}