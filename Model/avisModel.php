<?php
require_once 'connexionModel.php';

class avisModel {

    private $bdd ; 

    public function get_avis(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from avis where statut='valide'";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_avis_vehicule_all(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from avis where type=0";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    public function get_avis_marque(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from avis where type=1 and statut='valide'";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_avis_byTargetId($id,$type){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from avis where type=$type AND  target_id=$id and statut='valide' ";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_best_xavis_byTargetId($x,$id,$type){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from avis where statut='valide' AND  type=$type AND  target_id=$id order by note desc LIMIT $x";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    public function insert($avis){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        
        $query = $c->prepare("INSERT INTO Avis
        (note, commentaire, type, target_id, utilisateur_id, statut)
        VALUES (?, ?, ?, ?, ?, ?)");

       
        $query->bindParam(1, $avis['note']);
        $query->bindParam(2, $avis['commentaire']);
        $query->bindParam(3, $avis['type']);
        $query->bindParam(4, $avis['target_id']);
        $query->bindParam(5, $avis['utilisateur_id']);
        $query->bindParam(6, $avis['statut']);


        $query->execute();

                
        $this->bdd->deconnexion($c);
    
    }

    public function update_statut($id,$statut){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = $c->prepare("UPDATE avis SET statut = ? WHERE id = ?");
        $query->bindParam(1, $statut);
        $query->bindParam(2, $id);
        $query->execute();

        $this->bdd->deconnexion($c);

    }

    public function supprimer($id){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "DELETE FROM avis WHERE id =$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 

    }



  


}


?>