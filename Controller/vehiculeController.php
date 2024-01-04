<?php
require_once 'Model/vehiculeModel.php';


class Vehicule_controller {


    public function get_Vehicules_controller(){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicules();

        return $r ; 
    }

    public function get_vehicule_byId_controller($id){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicule_byId($id);

        return $r ; 
    }

    public function get_vehicule_byVersionId_controller($id){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicule_byVersionId($id);

        return $r ; 
    }

}
?>