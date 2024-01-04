<?php
require_once 'connexionModel.php';

class image {

    private $bdd ; 

    public function get_image_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select lien from image where id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

}

?>