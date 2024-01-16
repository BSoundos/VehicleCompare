<?php

// Les fichiers utilisés : 

require_once('Views/modifView.php');
require_once 'Model/adminModel.php';
require_once 'Model/vehiculeModel.php';
require_once 'Model/imageModel.php';
require_once 'Model/avisModel.php';
require_once 'Model/modeleModel.php';
require_once 'Model/marqueModel.php';


class adminModifController {

     /***************          Modification           ************ */

    // pour vehicule
    public function modifGenerate($var){
        $v = new modifView();
        $v->formDisplay($var);
    }

    // modification
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


    // générer pour Marque
    public function modifMarqueGenerate($Id){
        $v = new modifView();
        $v->modifMarqueDisplay($Id);
    }

    // modification
    public function modifyMarque($id,$marque,$lien){
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


    // générer pour News
    public function modifNewsGenerate($Id){
        $v = new modifView();
        $v->modifNewsDisplay($Id);
    }

    // modification
    public function modifyNews($id,$marque,$lien){
        $image_model = new image();
        $news_model = new newsModel();
        $image_controller = new image_controller();

        if ($lien === null ){ // user don't want to update image 
            $marque_md = $news_model->update_withoutimage($id,$marque);
           
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
            $r = $news_model->update($id,$marque,$imageId);
           
        }

        header('Location: index.php?action=admin&page=news');
        exit();
    }

    // générer pour News details
    public function modifNewsDetailsGenerate($Id){
        $v = new modifView();
        $v->modifNewsDetailsDisplay($Id);
    }

    // modification
    public function modifyNewsDetails($id,$marque,$lien){
        $image_model = new image();
        $news_model = new newsModel();
        $image_controller = new image_controller();

        if ($lien === null ){ // user don't want to update image 
            $marque_md = $news_model->updatedetails_withoutimage($id,$marque);
            
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
            $r = $news_model->updatedetails($id,$marque,$imageId);
            
        }

        header('Location: index.php?action=admin&page=newsdetails&id='.$marque['news_id']);
        exit();
    }




}

?>