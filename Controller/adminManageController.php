<?php

// Les fichiers utilisés : 
require_once('Views/ajoutView.php');
require_once('Views/modifView.php');
require_once 'Model/adminModel.php';
require_once 'Model/vehiculeModel.php';
require_once 'Model/imageModel.php';
require_once 'Model/modeleModel.php';
require_once 'Model/marqueModel.php';

class adminManageController {

    // générer l'ajout d'une véhicule 
    public function ajoutGenerate(){
        $v = new ajoutView();
        $v->formDisplay();
    }

    // l'ajout d'unevéhicule 
    public function ajoutVehicule($vehicule,$lien){

        $image_model = new image();
        $vehicule_model = new vehicule_model();

        $image = $image_model->insert($lien);
        $image = $image->fetch(PDO::FETCH_ASSOC);
        $imageId = $image['id'];


        $vehicule_md = $vehicule_model->insert($vehicule,$imageId);
        $vehicule_md = $vehicule_md->fetch(PDO::FETCH_ASSOC);
        $vehiculeId = $vehicule_md['id'];

        header('Location: index.php?action=admin&page=vehicule');
        exit();

    }


    // générer l'ajout d'une marque , modele , version
    public function ajoutLigneGenerate($var){
        $v = new ajoutView();
        $v->ajoutDisplay($var);
    }

    // l'ajout d'une marque , modele , version
    public function ajout($var,$valeur,$lien){

        $image_model = new image();
        switch($var) {
            case 'marque': 
                $model = new marque_model();

                $image = $image_model->insert($lien);
                $image = $image->fetch(PDO::FETCH_ASSOC);
                $imageId = $image['id'];


                $md = $model->insert($valeur,$imageId);
                $md = $md->fetch(PDO::FETCH_ASSOC);
                $Id = $md['id'];

                break; 
            
            case 'modele': 
                $model = new modele_model();

                $md = $model->insert($valeur);
                $md = $md->fetch(PDO::FETCH_ASSOC);
                $Id = $md['id'];



                break; 
                
            case 'version': 
                $model = new version_model();

                $md = $model->insert($valeur);
                $md = $md->fetch(PDO::FETCH_ASSOC);
                $Id = $md['id'];



                break; 
        }
    

        header('Location: index.php?action=admin&page=vehicule');
        exit();

    }

    public function modifLigneGenerate($var,$Id){
        $v = new modifView();
        $v->modifDisplay($var,$Id);
    }


    public function modifyVehicule($id,$vehicule,$lien){

        $image_model = new image();
        $vehicule_model = new vehicule_model();
        $image_controller = new image_controller();

        $image_id = $image_controller->get_image_byLien_controller($lien);
        $image_id = $image_id->fetch(PDO::FETCH_ASSOC);
        
        if ($image_id){
            // exists 
            $imageId = $image_id['id'];
        }
        else {
            // add the new one 
            $image = $image_model->insert($lien);
            $image = $image->fetch(PDO::FETCH_ASSOC);
            $imageId = $image['id'];
        }


        $vehicule_md = $vehicule_model->update($id,$vehicule,$imageId);

        header('Location: index.php?action=admin&page=vehicule');
        exit();

    }

    public function ajout($var,$valeur,$lien){

        $image_model = new image();
        switch($var) {
            case 'marque': 
                $model = new marque_model();

                $image = $image_model->insert($lien);
                $image = $image->fetch(PDO::FETCH_ASSOC);
                $imageId = $image['id'];


                $md = $model->insert($valeur,$imageId);
                $md = $md->fetch(PDO::FETCH_ASSOC);
                $Id = $md['id'];

                break; 
            
            case 'modele': 
                $model = new modele_model();

                $md = $model->insert($valeur);
                $md = $md->fetch(PDO::FETCH_ASSOC);
                $Id = $md['id'];



                break; 
                
            case 'version': 
                $model = new version_model();

                $md = $model->insert($valeur);
                $md = $md->fetch(PDO::FETCH_ASSOC);
                $Id = $md['id'];



                break; 
        }
    

        header('Location: index.php?action=admin&page=vehicule&tache=ajout');
        exit();

    }



    public function modifGenerate($var){
        $v = new modifView();
        $v->formDisplay($var);
    }



    public function supp($page,$Id){
        switch($page){
            case 'vehicule':
                $model = new vehicule_model();
                break;

            case 'marque':
                $model = new marque_model();
                break;
            
            case 'modele':
                $model = new modele_model();
                break;

            case 'version':
                $model = new version_model();
                break;
        }

        $md = $model->supprimer($Id);
        header('Location: index.php?action=admin&page=vehicule');

    }


}

?>