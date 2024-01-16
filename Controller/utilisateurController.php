<?php
require_once 'Model/utilisateurModel.php';


class userController {


    public function update_statut($id,$statut){
        $m = new user_model();
        $m->update_statut($id,$statut);
    }

    public function get_users_controller(){
        $mtf = new user_model();
        $r = $mtf->get_users();

        return $r ; 
    }

    public function get_user_byID($id){
        $mtf = new user_model();
        $r = $mtf->get_user_byID($id);

        return $r ; 
    }

    public function get_nonAdmin_users_controller(){
        $mtf = new user_model();
        $r = $mtf->get_nonAdmin_users();

        return $r ; 
    }




}
?>