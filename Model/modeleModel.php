<?php
require_once 'connexionModel.php';

class modele_model {

    private $bdd ; 

    public function get_Modeles(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from modele";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_modele_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from modele where id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_modele_byMarqueId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from modele where marque_id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }
  
    public function insert($modele){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("INSERT INTO Modele
        (nom, marque_id)
        VALUES (?, ?)");
    
        $query->bindParam(1, $modele['nom']);
        $query->bindParam(2, $modele['marque_id']);
    
        $query->execute();
    
        $query = "SELECT * FROM modele ORDER BY id DESC LIMIT 1";
        $r = $this->bdd->requete($c, $query);
                
        $this->bdd->deconnexion($c);
        return $r;      
    }

    public function supprimer($id){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "DELETE FROM modele WHERE id =$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 

    }
   
    
}


?>