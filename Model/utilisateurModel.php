<?php
require_once 'connexionModel.php';

class user_model {

    private $bdd ; 

    public function update_statut($id,$statut){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = $c->prepare("UPDATE Utilisateur SET statut = ? WHERE id = ?");
        $query->bindParam(1, $statut);
        $query->bindParam(2, $id);
        $query->execute();

        $this->bdd->deconnexion($c);

    }

    public function get_users(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "Select * from Utilisateur";

        $r = $this->bdd->requete($c, $query);
        
                
        $this->bdd->deconnexion($c);
        return $r; 

    }

    public function get_nonAdmin_users(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "Select * from Utilisateur where role='client' ";

        $r = $this->bdd->requete($c, $query);
        
                
        $this->bdd->deconnexion($c);
        return $r; 

    }
    
    public function get_user_byID($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "Select * from Utilisateur where id=$id";

        $r = $this->bdd->requete($c, $query);
        
                
        $this->bdd->deconnexion($c);
        return $r; 

    }
    
   
    
 
  

}


?>