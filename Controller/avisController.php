<?php
require_once 'Model/avisModel.php';
require_once 'Views/avisView.php';

class avisController {

    public function update_statut($id,$statut){

        $model = new avisModel();
        $md = $model->update_statut($id,$statut);

    }


    // add avis 
    public function ajoutVehiculeAvis($var){

        $model = new avisModel();
        $avis=[
            'note' => $var['note'],
            'commentaire' => $var['commentaire'],
            'utilisateur_id' => $var['utilisateur_id'],
            'target_id' => $var['target_id'] ,
            'statut' => 'en attente',
            'type' => 0                 
        ];
        $md = $model->insert($avis);

        $var = $avis['target_id'];
        header('Location: index.php?action=vehicules&id='.$var);
        exit();

    }

    public function ajoutMarqueAvis($var){

        $model = new avisModel();
        $avis=[
            'note' => $var['note'],
            'commentaire' => $var['commentaire'],
            'utilisateur_id' => $var['utilisateur_id'],
            'target_id' => $var['target_id'] ,
            'statut' => 'en attente',
            'type' => 1                 
        ];


        $md = $model->insert($avis);

        $var = $avis['target_id'];
        header('Location: index.php?action=marques&id='.$var);
        exit();

    }

    public function get_avis_vehicule_controller(){
        $mtf = new avisModel();
        $r = $mtf->get_avis_vehicule_all();

        return $r ; 
    }


    public function get_avis_marque_controller(){
        $mtf = new avisModel();
        $r = $mtf->get_avis_marque();

        return $r ; 
    }


    public function get_avis_controller(){
        $mtf = new avisModel();
        $r = $mtf->get_avis();

        return $r ; 
    }


    public function get_avis_byType_controller($type){
        if($type === 0){
           return $this->get_avis_vehicule_controller();
        }
        else {
            return $this->get_avis_marque_controller();

        }

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

    public function avisGenerate($type) {
        $v = new avisView();
        $v->AvisDisplay($type);

    }

    public function avisDetailsGenerate($targetId,$type) {
        $v = new avisView();
        $v->AvisDetailsDisplay($targetId,$type);

    }


    public function avisDisplay2part($target_id,$type) {
        $v = new avisView();
        $v->avisDisplay2part($target_id,$type);

    }

    public function avisPageDisplay() {
        $v = new avisView();
        $v->avisPageDisplay();

    }


    public function avisInsideDisplay($id_marque) {
        $v = new avisView();
        $v->avisInsideDisplay($id_marque);

    }

    public function paginate() {
        $v = new avisView();
        $v->paginate();

    }

    public function load() {
        $v = new avisView();
        $v->load();

    }

    


    



}
?>