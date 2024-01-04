<?php
require_once 'Model/marqueModel.php';

class marque_controller {


    public function get_Marques_controller(){
        $mtf = new marque_model();
        $r = $mtf->get_Marques();

        return $r ; 
    }

    public function get_marque_byId_controller($id){
        $mtf = new marque_model();
        $r = $mtf->get_marque_byId($id);

        return $r ; 
    }

}
?>