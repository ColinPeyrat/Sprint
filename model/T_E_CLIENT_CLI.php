<?php

class T_E_CLIENT_CLI extends Model
{
    protected $_cli_id;
    protected $_cli_mel;
    protected $_cli_motpasse;
    protected $_cli_pseudo;
    protected $_cli_civilite;
    protected $_cli_nom;
    protected $_cli_prenom;
    protected $_cli_telfixe;
    protected $_cli_telportable;
    protected $_connected;


    public function userExistInDb()
    {
        $st = db()->prepare("select * from t_e_client_cli where cli_pseudo=:login AND cli_motpasse=:password");
        $st->bindValue(":login", $this->_cli_pseudo);
        $st->bindValue(":password", $this->_cli_motpasse);
        $st->execute();
        if ($st->rowCount() >= 1){
            $this->_connected = true;
        } else
            $this->_connected = false;

    }
}