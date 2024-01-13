<?php
require_once 'connexionModel.php';

class marque_model {

    private $bdd ; 

    public function get_Marques(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from marque";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_marque_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from marque where id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }
   
    public function get_firstx_marques($x){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from marque LIMIT $x";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    public function insert($marque,$imageId){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("INSERT INTO Marque
        (nom, pays_origine, siege_social, annee_creation, lien, image_id)
        VALUES (?, ?, ?, ?, ?, ?)");

        $query->bindParam(1, $marque['nom']);
        $query->bindParam(2, $marque['pays_origine']);
        $query->bindParam(3, $marque['siege_social']);
        $query->bindParam(4, $marque['annee_creation']);
        $query->bindParam(5, $marque['lien']);
        $query->bindParam(6, $imageId);


        $query->execute();

       
        $query = "SELECT * FROM marque ORDER BY id DESC LIMIT 1";
        $r = $this->bdd->requete($c, $query);
                
        $this->bdd->deconnexion($c);
        return $r;      
    }

    public function supprimer($id){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "DELETE FROM marque WHERE id =$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 

    }
   

}


?>