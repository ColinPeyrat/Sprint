<?php
class SERVICE_CLIENTController extends Controller
{
    public function index(){
        $this->render("index");
    }

    public function order(){

        if(isset($_POST['date']) && !empty($_POST['date'])){
            $c = T_E_COMMANDE_COM::findByDate(date("Y-d-m", strtotime($_POST['date'])));
        }
        else
            $c = T_E_COMMANDE_COM::findAll();

        $data = array();
        foreach($c as $key=>$value){
            unset($d);
            $d['commande'] = $value;
            foreach(T_J_LIGNECOMMANDE_LEC::findAllProductforOneOrder($value->com_id) as $k=>$v){
                $d['produit'][] = $v;
            }
            array_push($data,$d);
        }

        $this->render("order", $data);
    }
}