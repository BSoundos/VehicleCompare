<?php
require_once 'Model/newsModel.php';

class diaporama_controller {


    public function get_Diaporama_controller(){
        $mtf = new newsModel();
        $r = $mtf->get_Diaporama();

        return $r ; 
    }

 
}
?>