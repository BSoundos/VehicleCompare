<?php
require_once 'Model/utilisateurModel.php';


class userController {


    public function update_statut($id,$statut){
        $m = new user_model();
        $m->update_statut($id,$statut);
    }





}
?>