<?php
require_once 'Model/vehiculeModel.php';
require_once 'Model/favorisModel.php';
require_once 'Views/vehiculeView.php';

class Vehicule_controller {

    public function vehiculeCaracGenerate($vehiculeId){
        $v = new vehiculeView();
        $v->vehiculeCaracDisplay($vehiculeId);
    }


    public function vehiculeDetailsGenerate($vehiculeId){
        $v = new vehiculeView();
        $v->vehiculeDetailsDisplay($vehiculeId);
    }


    public function get_Vehicules_controller(){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicules();

        return $r ; 
    }

    public function get_vehicule_byId_controller($id){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicule_byId($id);

        return $r ; 
    }

    public function get_vehicule_andids($id){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicule_andids($id);

        return $r ; 
    }

    

    public function get_vehicule_byVersionId_controller($id){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicule_byVersionId($id);

        return $r ; 
    }

    public function get_vehicule_byMarqueId_controller($id){
        $mtf = new vehicule_model();
        $r = $mtf->get_vehicule_byMarqueId($id);

        return $r ; 
    }

    public function get_marque_modele_version_annee_controller(){
        $mtf = new vehicule_model();
        $r = $mtf->get_marque_modele_version_annee();

        return $r ; 
    }

    public function get_modele_version_annee_controller_bymarque($id_marque){
        $mtf = new vehicule_model();
        $r = $mtf->get_modele_version_annee_bymarque($id_marque);

        return $r ; 
    }


    public function ajouterFavoris($target,$id){

        $m = new FavorisModel();
        $m->ajouterFavoris($target,$id);

        // header to vehicule details
        header('Location: index.php?action=vehicules&id='.$target);


    }


    public function suppFavoris($target,$id){

        $m = new FavorisModel();
        $m->suppFavoris($target,$id);

        // header to vehicule details
        header('Location: index.php?action=vehicules&id='.$target);
        

    }



    public function getFavoris($vehicule_id,$utilisateur_id){
        $m = new FavorisModel();
        $r = $m->getFavoris($vehicule_id,$utilisateur_id);

        return $r ; 
    }

    public function getFavoris_byUserID($utilisateur_id){
        $m = new FavorisModel();
        $r = $m->getFavoris_byUserID($utilisateur_id);

        return $r ; 
    }
    

}
?>