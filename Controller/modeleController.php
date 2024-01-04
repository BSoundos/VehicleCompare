<?php
require_once 'Model/modeleModel.php';


class Modele_controller {


    public function get_Modeles_controller(){
        $mtf = new modele_model();
        $r = $mtf->get_Modeles();

        return $r ; 
    }

    public function get_modele_byId_controller($id){
        $mtf = new modele_model();
        $r = $mtf->get_modele_byId($id);

        return $r ; 
    }

    public function get_modele_byMarqueId_controller($id){
        $mtf = new modele_model();
        $r = $mtf->get_modele_byMarqueId($id);

        return $r ; 
    }



}
?>