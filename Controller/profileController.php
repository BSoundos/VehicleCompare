<?php

// Les fichiers utilisés : 
require_once('Views/profileView.php');
require_once('Views/zone1View.php');
require_once('Views/zone2View.php');
require_once('Views/zone3View.php');

class ProfileController {

    public function profileGenerate($id){
        $v = new ProfileView();
        $v->profileDisplay($id);
    }
}

?>