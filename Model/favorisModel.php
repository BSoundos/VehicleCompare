<?php
require_once 'connexionModel.php';

class FavorisModel {

    private $bdd ; 

    public function ajouterFavoris($vehicule_id,$utilisateur_id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();


        $query = $c->prepare("INSERT INTO Favoris (vehicule_id, utilisateur_id) Values 
        (?, ?)");

        $query->bindParam(1, $vehicule_id);
        $query->bindParam(2, $utilisateur_id);



        $query->execute();
        
        $this->bdd->deconnexion($c);
        
    }

    public function getFavoris($vehicule_id,$utilisateur_id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from favoris where vehicule_id = '$vehicule_id' AND utilisateur_id = '$utilisateur_id' ";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
        
    }

    
    public function getFavoris_byUserID($utilisateur_id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = " SELECT V.id , V.nom,
        I.lien AS image_lien
        FROM Vehicule AS V
        JOIN Image AS I ON V.image_id = I.id
        WHERE V.id IN (SELECT vehicule_id FROM favoris WHERE utilisateur_id = $utilisateur_id)
        ";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
        
    }



    public function suppFavoris($vehicule_id,$utilisateur_id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "delete from favoris where vehicule_id = '$vehicule_id' AND utilisateur_id = '$utilisateur_id' ";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
        
    }


}


?>