<?php

// Les fichiers utilisés : 
require_once('Views/ajoutView.php');
require_once('Views/modifView.php');
require_once 'Model/adminModel.php';
require_once 'Model/vehiculeModel.php';
require_once 'Model/imageModel.php';
require_once 'Model/avisModel.php';
require_once 'Model/modeleModel.php';
require_once 'Model/marqueModel.php';
require_once 'Controller/avisController.php';
require_once 'Controller/utilisateurController.php';

class adminManageController {

    /***************          Ajout           ************ */
    // générer l'ajout d'une véhicule 
    public function ajoutGenerate($id_marque){
        $v = new ajoutView();
        $v->formDisplay($id_marque);
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

        header('Location: index.php?action=admin&page=vehicule&id_marque='.$vehicule['marque_id']);
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
              

                break; 
            
            case 'modele': 
                $model = new modele_model();

                $md = $model->insert($valeur);
             



                break; 
                
            case 'version': 
                $model = new version_model();

                $md = $model->insert($valeur);
              
                break; 

            case 'avis': 
                $model = new avisModel();

                $md = $model->insert($valeur);
              
                break; 
        }
    

        header('Location: index.php?action=admin&page='.$var.'&tache=ajout');
        exit();

    }

    public function ajoutAvis($vehiculeavis){
        $model = new avisModel();
        $md = $model->insert($vehiculeavis);

        header('Location: index.php?action=admin&page=avis');
        exit();
    }



    /***************          Modification           ************ */

    // pour vehicule
    public function modifGenerate($var){
        $v = new modifView();
        $v->formDisplay($var);
    }

    public function modifyVehicule($id,$vehicule,$lien){

        $image_model = new image();
        $vehicule_model = new vehicule_model();
        $image_controller = new image_controller();

        if ($lien === null ){ // user don't want to update image 
            $vehicule_md = $vehicule_model->update_withoutimage($id,$vehicule);
        }
        else {
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
        }

        header('Location: index.php?action=admin&page=vehicule&id_marque='.$vehicule['marque_id']);
        exit();

    }


    // générer pour les autres : marque , modele , version
    public function modifLigneGenerate($var,$Id){
        $v = new modifView();
        $v->modifDisplay($var,$Id);
    }

    public function modify($id,$marque,$lien){
        $image_model = new image();
        $marque_model = new marque_model();
        $image_controller = new image_controller();

        if ($lien === null ){ // user don't want to update image 
            $marque_md = $marque_model->update_withoutimage($id,$marque);
           
        }
        else {
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
            $marque_md = $marque_model->update($id,$marque,$imageId);
           
        }

        header('Location: index.php?action=admin&page=marque');
        exit();
    }

    // la suppression 
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
        header('Location: index.php?action=admin');
        

    }



    /************************  avis *********************** */
    public function refusComment($id){
        // update statut to refuse
        $ctr = new avisController();
        $ctr->update_statut($id,'refuse');

        header('Location: index.php?action=admin&page=avis');
        exit();

    }

    public function bloqueUser($id){
        // update statut to bloque
        $ctr = new userController();
        $ctr->update_statut($id,'bloque');

        header('Location: index.php?action=admin&page=avis');
        exit();

    }
}

?>