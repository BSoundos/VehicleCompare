<?php
require_once 'Model/avisModel.php';
require_once 'Views/avisView.php';

class avisController {

    public function get_avis_controller(){
        $mtf = new avisModel();
        $r = $mtf->get_avis();

        return $r ; 
    }

    public function get_best_xavis_byTargetId_controller($x,$id,$type){
        $mtf = new avisModel();
        $r = $mtf->get_best_xavis_byTargetId($x,$id,$type);

        return $r ; 
    }

    public function get_avis_byTargetId_controller($id,$type){
        $mtf = new avisModel();
        $r = $mtf->get_avis_byTargetId($id,$type);

        return $r ; 
    }

    public function avisGenerate($targetId,$type) {
        $v = new avisView();
        $v->AvisDisplay($targetId,$type);

    }


    



}
?>