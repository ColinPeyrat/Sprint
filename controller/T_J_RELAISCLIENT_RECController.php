<?php

class T_J_RELAISCLIENT_RECController extends Controller
{
    public function removeRelay(){
        if (isset($_SESSION['user'])) {
            if (isset($_GET['rel_id'])) {
                T_J_RELAISCLIENT_REC::removeRelayClient($_SESSION['user']->cli_id,$_GET['rel_id']);
                $m = new message();
                $m->setFlash('Le relais a bien été supprimé','success');
                header("Refresh:0; url=../Sprint/?r=cli/myRelay");

            }
        }
    }
}