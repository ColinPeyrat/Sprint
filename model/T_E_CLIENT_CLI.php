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
        $st = db()->prepare("select * from t_e_client_cli where cli_mel=:mel AND cli_motpasse=:password");
        $st->bindValue(":mel", $this->_cli_mel);
        $st->bindValue(":password", $this->_cli_motpasse);
        $st->execute();
        if ($st->rowCount() >= 1){

                $st = db()->prepare("select cli_id from t_e_client_cli where cli_mel=:mel");
                $st->bindValue(":mel", $this->_cli_mel);
                $st->execute();
                $f = $st->fetch();
                $client =  new T_E_CLIENT_CLI($f["cli_id"]);
                $client->_connected = true;
            return $client;
        } else
            $this->_connected = false;

    }
    public function displayInfo() {
        $info = array("Mail","Mot de passe","Pseudo","Civilité","Nom","Prenom","Téléphone Fixe","Téléphone Portable");
        $i = 0;

        $value = array();
        foreach($this as $key) {
            $value[] = $key;
        }
        echo "<table class=\"table\">";
        echo "<tbody>";
        foreach ($info as $inf) {
            echo "<tr>";
            echo "<td>".$inf."</td>";
            echo "<td>".$value[$i + 1];
            if($value[$i + 1] == null)
                echo "Inconnu";
            $i++;
            echo "</td>";


        }
        echo "</tbody>";
        echo "</table>";


    }
    public function modifyInfo($mail,$mdp,$pseudo,$civilite,$nom,$prenom,$tfixe,$tport){
        $this->__set("cli_mel",$mail);
        $this->__set("cli_motpasse",$mdp);
        $this->__set("cli_pseudo",$pseudo);
        $this->__set("cli_civilite",$civilite);
        $this->__set("cli_nom",$nom);
        $this->__set("cli_prenom",$prenom);
        $this->__set("cli_telfixe",$tfixe);
        $this->__set("cli_telportable",$tport);


    }
    public function displayModifyInfo() {
        ?>
        <form method="post" action="?r=cli/modify">
        <?php
        $info = array("Mail","Mot de passe","Pseudo","Civilité","Nom","Prenom","Téléphone Fixe","Téléphone Portable");
        $i = 0;


        foreach($this as $key=>$value) {
            $name[] = substr($key,5);
            $valu[] = $value;
        }
        foreach ($info as $inf) {

            if($valu[$i + 1] == null)
                $valuetext = "Inconnu";
            else
                $valuetext = $valu[$i + 1];
            echo "<label>$inf</label>";
            if($name[$i + 1] =="civilite") {
                ?>
                <select class="form-control" name="civilite">
                <option value="M.">M.</option>
                <option value="Mme">Mme</option>
                <option value="Mlle">Mlle</option>
                </select>
                <?php
            } else

            echo "<input type=\"text\" name=\"".$name[$i + 1]."\" value=\"$valuetext\"><br>";
//            echo "<td>".$inf."</td>";
//            echo "<td>".$value[$i + 1];
//            if($value[$i + 1] == null)
//                echo "Inconnu";
            $i++;
//            echo "</td>";


        }
        echo "<input name='action' type='submit' value='Modifier'>";
        echo "</form>";



    }
}