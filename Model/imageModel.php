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

    public function get_image_byLien($lien){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from image where lien='$lien'";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function supprimer($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "Delete from image where id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function insert($lien){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "insert into image (lien) values ('$lien')";

        $r = $this->bdd->requete($c,$query);
        
        $query = "SELECT * FROM image ORDER BY id DESC LIMIT 1";
        $r = $this->bdd->requete($c, $query);
                
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    

}

?>