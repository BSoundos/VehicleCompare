<?php

// Les fichiers utilisés : 
require_once('Views/acceuilView.php');

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

    public function zone2($i,$version,$modele,$marque){
        $v = new acceuilView();
        $v->zone2($i,$version,$modele,$marque);
    }

    public function footer(){
        $v = new acceuilView();
        $v->footer();
    }


}
 
?>