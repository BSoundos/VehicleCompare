<?php

// Les fichiers utilisés : 
require_once('Views/adminPrincipalView.php');
require_once('Views/vehiculeAdminView.php');
require_once 'Model/adminModel.php';

class adminController {

    public function pagePrincipalGenerate(){
        $v = new adminView();
        $v->pagePrincipalDisplay();
    }

    public function VehiculeAdminGenerate(){
        $v = new VehiculeAdminView();
        $v->vehiculeDisplay();
    }

    public function manageLinksGenerate(){
        $v = new adminView();
        $v->manageLinks();
    }

    public function get_images_controller(){
        $mtf = new adminModel();
        $r = $mtf->get_images();

        return $r ; 
    }

}

?>