<?php

// Les fichiers utilisés : 

require_once 'Model/vehiculeModel.php';
require_once 'Model/modeleModel.php';
require_once 'Model/marqueModel.php';
require_once 'Model/versionModel.php';
require_once 'Model/newsModel.php';

class adminSuppController {

    /* la suppression */
    public function suppVehicule($Id,$id_marque){ // marque id 
        
        $model = new vehicule_model();
        $md = $model->supprimer($Id);
        header('Location: index.php?action=admin&page=vehicule&id_marque='.$id_marque);
        

    }

    public function suppMarque($Id){
        
        $model = new marque_model();
        $md = $model->supprimer($Id);
        header('Location: index.php?action=admin&page=marque');
        

    }

    public function suppModele($Id){
        
        $model = new modele_model();
        $md = $model->supprimer($Id);
        header('Location: index.php?action=admin&page=version&tache=supp');
        

    }

    public function suppVersion($Id){
        
        $model = new version_model();
        $md = $model->supprimer($Id);
        header('Location: index.php?action=admin&page=version&tache=supp');
        

    }

    public function suppAvis($Id){
        
        $model = new avisModel();
        $md = $model->supprimer($Id);
        header('Location: index.php?action=admin&page=avis');
        

    }

    public function suppNews($Id){
        
        $model = new newsModel();
        $md = $model->supprimer($Id);
        header('Location: index.php?action=admin&page=news');
        

    }

    public function suppNewsDetails($Id,$id_news){
        
        $model = new newsModel();
        $md = $model->supprimerdetails($Id);
        header('Location: index.php?action=admin&page=news&id_news='.$id_news);
        

    }

}
    
?>