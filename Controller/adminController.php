<?php

// Les fichiers utilisés : 
require_once('Views/adminPrincipalView.php');
require_once('Views/vehiculeAdminView.php');
require_once('Views/marqueAdminView.php');
require_once('Views/avisAdminView.php');
require_once('Views/newsAdminView.php');
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

    public function marqueAdminGenerate(){
        $v = new marqueAdminView();
        $v->marqueDisplay();
    }

    public function avisAdminGenerate(){
        $v = new AvisAdminView();
        $v->avisDisplay();
    }


    public function newsAdminGenerate(){
        $v = new NewsAdminView();
        $v->newsDisplay();
    }

    public function newsDetailsAdminGenerate($id){
        $v = new NewsAdminView();
        $v->newsDetailsDisplay($id);
    }

    


    public function deleteGenerate(){
        $v = new marqueAdminView();
        $v->deleteView();
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