<?php
require_once 'Model/newsModel.php';
require_once('Views/diapoView.php');

class diaporama_controller {


    public function get_Diaporama_controller(){
        $mtf = new newsModel();
        $r = $mtf->get_Diaporama();

        return $r ; 
    }

    public function diapoGenerate(){
        $v = new diapoView();
        $v->DiapoDisplay();
    }
   

 
}
?>