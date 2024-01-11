<?php
require_once 'Model/comparaisonModel.php';


class Comparaison_controller {


    public function get_comparaisons_controller(){
        $mtf = new comparaison_model();
        $r = $mtf->get_Comparaisons();

        return $r ; 
    }

    public function get_comparaison_byId($id){
        $mtf = new comparaison_model();
        $r = $mtf->get_comparaison_byId($id);

        return $r ; 
    }

    public function get_comparaison_byVehiculeId($id){
        $mtf = new comparaison_model();
        $r = $mtf->get_comparaison_byVehiculeId($id);

        return $r ; 
    }

    public function get_firstx_comparaisons($x){
        $mtf = new comparaison_model();
        $r = $mtf->get_firstx_comparaisons($x);

        return $r ; 
    }

    public function update_comparaison($x,$y){
        $mtf = new comparaison_model();
        $r = $mtf->update_comparaison($x,$y);

        return $r ; 
    }



}
?>