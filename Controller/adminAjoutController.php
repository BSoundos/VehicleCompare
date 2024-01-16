<?php

// Les fichiers utilisés : 
require_once('Views/ajoutView.php');

require_once 'Model/adminModel.php';
require_once 'Model/vehiculeModel.php';
require_once 'Model/imageModel.php';
require_once 'Model/avisModel.php';
require_once 'Model/newsModel.php';
require_once 'Model/modeleModel.php';
require_once 'Model/marqueModel.php';

class adminAjoutController {

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
    public function ajoutMarqueGenerate(){
        $v = new ajoutView();
        $v->ajoutDisplayMarque();
    }

    public function ajoutModeleGenerate(){
        $v = new ajoutView();
        $v->ajoutDisplayModele();
    }

    public function ajoutVersionGenerate(){
        $v = new ajoutView();
        $v->ajoutDisplayVersion();
    }

    public function ajoutNewsGenerate(){
        $v = new ajoutView();
        $v->ajoutDisplayNews();
    }

    public function ajoutNewsDetailsGenerate($id){
        $v = new ajoutView();
        $v->ajoutDisplayNewsDetails($id);
    }



    // l'ajout d'une marque , modele , version
    public function ajoutMarque($valeur,$lien){
        $image_model = new image();
        $model = new marque_model();

        $image = $image_model->insert($lien);
        $image = $image->fetch(PDO::FETCH_ASSOC);
        $imageId = $image['id'];


        $md = $model->insert($valeur,$imageId);

        header('Location: index.php?action=admin&page=marque&tache=ajout');
        exit();

    }

    public function ajoutModele($valeur){
        $model = new modele_model();

        $md = $model->insert($valeur);

        header('Location: index.php?action=admin&page=modele&tache=ajout');
        exit();
    }

    public function ajoutVersion($valeur){
        $model = new version_model();

        $md = $model->insert($valeur);

        header('Location: index.php?action=admin&page=version&tache=ajout');
        exit();
    }
 

    public function ajoutAvis($vehiculeavis){
        $model = new avisModel();
        $md = $model->insert($vehiculeavis);

        header('Location: index.php?action=admin&page=avis');
        exit();
    }

    public function ajoutNews($valeur,$lien){
        $image_model = new image();
        $model = new newsModel();

        $image = $image_model->insert($lien);
        $image = $image->fetch(PDO::FETCH_ASSOC);
        $imageId = $image['id'];


        $md = $model->insert($valeur,$imageId);

        header('Location: index.php?action=admin&page=news&tache=ajout');
        exit();

    }

    public function ajoutNewsDetails($valeur,$lien){
        $image_model = new image();
        $model = new newsModel();

        $image = $image_model->insert($lien);
        $image = $image->fetch(PDO::FETCH_ASSOC);
        $imageId = $image['id'];


        $md = $model->insertdetails($valeur,$imageId);

        header('Location: index.php?action=admin&page=news');
        exit();

    }


}



   

    

?>