<?php

// Les fichiers utilisés : 
require_once('Views/comparateurView.php');

class comparateurController {

    public function comparateurGenerate(){
        $v = new comparateurView();
        $v->comparateurDisplay();
    }

}
 
?>