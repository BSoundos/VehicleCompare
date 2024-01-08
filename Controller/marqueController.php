<?php
require_once 'Model/marqueModel.php';
require_once 'Views/marqueView.php';

class marqueController {

    public function marquesGenerate(){
        $v = new marqueView();
        $v->marquesDisplay();
    }

    public function get_Marques_controller(){
        $mtf = new marque_model();
        $r = $mtf->get_Marques();

        return $r ; 
    }

    public function get_firstx_marques_controller($x){
        $mtf = new marque_model();
        $r = $mtf->get_firstx_marques($x);

        return $r ; 
    }

    public function get_marque_byId_controller($id){
        $mtf = new marque_model();
        $r = $mtf->get_marque_byId($id);

        return $r ; 
    }

    public function marqueDetailsGenerate($id){
        $v = new marqueView();
        $v->marqueDetailsDisplay($id);
    }


}
?>