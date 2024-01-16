<?php
require_once 'connexionModel.php';

class adminModel {

    private $bdd ; 

    public function get_images(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT parameters.nom, Image.lien FROM parameters
                JOIN Image ON parameters.image_id = Image.id where param=0";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_params(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT * FROM parameters where param=1";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_params_spec($nom){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT * FROM parameters where nom=$nom";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }





}


?>