<?php

// Les fichiers utilisés : 
require_once('Views/acceuilView.php');


class acceuilController {

    public function acceuilGenerate(){
        $v = new acceuilView();
        $v->AcceuilDisplay();
    }

}
 
?>