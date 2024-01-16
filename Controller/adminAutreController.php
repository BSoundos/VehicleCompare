<?php

// Les fichiers utilisés : 

require_once 'Controller/avisController.php';
require_once 'Controller/utilisateurController.php';
require_once 'Views/avisAdminView.php';
require_once 'Views/userAdminView.php';

class adminAutreController {


/************************  avis *********************** */
    public function refusComment($id){
        // update statut to refuse
        $ctr = new avisController();
        $ctr->update_statut($id,'refuse');

        header('Location: index.php?action=admin&page=avis');
        exit();

    }

    public function bloqueUser($id){
        // update statut to bloque
        $ctr = new userController();
        $ctr->update_statut($id,'bloque');

        header('Location: index.php?action=admin&page=user');
        exit();

    }

    public function valideUser($id){
        // update statut to valide
        $ctr = new userController();
        $ctr->update_statut($id,'valide');

        header('Location: index.php?action=admin&page=user');
        exit();

    }

    public function valideAvis($id){
        // update statut to valide
        $ctr = new avisController();
        $ctr->update_statut($id,'valide');

        header('Location: index.php?action=admin&page=avis');
        exit();

    }

    public function filterAvis(){
        $v = new AvisAdminView();
        $v->filter();
    }

    public function filterUser(){
        $v = new UserAdminView();
        $v->filter();
    }

}
?>