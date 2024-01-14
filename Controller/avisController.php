<?php
require_once 'Model/avisModel.php';
require_once 'Views/avisView.php';

class avisController {

    public function update_statut($id,$statut){

        $model = new avisModel();
        $md = $model->update_statut($id,$statut);

    }


    // add avis 
    public function ajoutVehiculeAvis($avis){

        $model = new avisModel();
        $md = $model->insert($avis);

        $var = $avis['target_id'];
        header('Location: index.php?action=vehicules&id='.$var);
        exit();

    }

    public function ajoutMarqueAvis($avis){

        $model = new avisModel();
        $md = $model->insert($avis);

        $var = $avis['target_id'];
        header('Location: index.php?action=marques&id='.$var);
        exit();

    }

    public function get_avis_vehicule_controller(){
        $mtf = new avisModel();
        $r = $mtf->get_avis_vehicule();

        return $r ; 
    }

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

    public function avisDisplay2part($target_id,$type) {
        $v = new avisView();
        $v->avisDisplay2part($target_id,$type);

    }

    


    



}
?>