<?php
require_once 'connexionModel.php';

class adminModel {

    private $bdd ; 

    public function get_images(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT parameters.nom, Image.lien FROM parameters
                JOIN Image ON parameters.image_id = Image.id;";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }



}


?>