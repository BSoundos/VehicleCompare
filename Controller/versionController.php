<?php
require_once 'Model/versionModel.php';

class Version_controller {


    public function get_versions_controller(){
        $mtf = new version_model();
        $r = $mtf->get_Versions();

        return $r ; 
    }

    public function get_version_byId_controller($id){
        $mtf = new version_model();
        $r = $mtf->get_version_byId($id);

        return $r ; 
    }

    public function get_version_byModeleId_controller($id){
        $mtf = new version_model();
        $r = $mtf->get_version_byModeleId($id);

        return $r ; 
    }


    public function get_modele_marque_byid_controller($id){
        $mtf = new version_model();
        $r = $mtf->get_modele_marque_byid($id);

        return $r ; 
    }


}
?>