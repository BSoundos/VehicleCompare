<?php

// Les fichiers utilisés : 
require_once('Views/acceuilView.php');
require_once('Views/zone1View.php');
require_once('Views/zone2View.php');
require_once('Views/zone3View.php');

class acceuilController {

    public function acceuilGenerate(){
        $v = new acceuilView();
        $v->AcceuilDisplay();
    }

    public function head(){
        $v = new acceuilView();
        $v->head();
    }

    public function header(){
        $v = new acceuilView();
        $v->header();
    }

    public function menu(){
        $v = new acceuilView();
        $v->menu();
    }

    public function zone1(){
        $v = new zone1View();
        $v->Zone1Display();
    }

    public function zone2($i,$version,$modele,$marque){
        $v = new zone2View();
        $v->Zone2Display($i,$version,$modele,$marque);
    }

    public function zone3(){
        $v = new zone3View();
        $v->Zone3Display();
    }

    public function displayVehicule_byId($vehicule,$version,$className){
        $v = new zone3View();
        $v->displayVehicule_byId($vehicule,$version,$className);
    }

    public function footer(){
        $v = new acceuilView();
        $v->footer();
    }


}
 
?>