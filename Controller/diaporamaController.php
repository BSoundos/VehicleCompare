<?php
require_once 'Model/diaporamaModel.php';

class diaporama_controller {


    public function get_Diaporama_controller(){
        $mtf = new diaporama();
        $r = $mtf->get_Diaporama();

        return $r ; 
    }

    public function get_diapo_byId_controller($id){
        $mtf = new diaporama();
        $r = $mtf->get_diapo_byId($id);

        return $r ; 
    }

}
?>