<?php
require_once 'Model/imageModel.php';

class image_controller {


    public function get_image_controller($id){

        $mtf = new image();
        $r = $mtf->get_image_byId($id);
        
        return $r ; 
    }

    public function get_image_byLien_controller($lien){

        $mtf = new image();
        $r = $mtf->get_image_byLien($lien);
        
        return $r ; 
    }
}
?>