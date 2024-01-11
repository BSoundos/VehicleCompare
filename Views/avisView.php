<?php
// Les fichiers utilisés :
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');
require_once('Views/zone3View.php');

class avisView {

    private $acceuil_controller ;
    private $vehicule_controller ; 
    private $version_controller ; 
    private $image_controller ; 

    private $modeleController;
    private $marqueController;
    private $avisController;

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->image_controller = new image_controller();
        $this->version_controller = new Version_controller();
        $this->comparaison_controller = new Comparaison_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new marqueController();
        $this->avisController = new avisController();
    }

    public function AvisDisplay($targetId,$type) {
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();

        $avis = $this->avisController->get_avis_byTargetId_controller($targetId,$type);
        $avis = $avis->fetchAll(PDO::FETCH_ASSOC);



    }
}

