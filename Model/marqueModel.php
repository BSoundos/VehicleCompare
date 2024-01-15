<?php
require_once 'connexionModel.php';

class marque_model {

    private $bdd ; 

    public function get_Marques(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT 
        m.*,
        i.lien AS image_lien
        FROM 
            marque m
        LEFT JOIN 
        image i ON m.image_id = i.id";

        $r = $this->bdd->requete($c,$query);
        
     
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_marque_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "
        SELECT 
            m.*,
            i.lien AS image_lien
        FROM 
            marque m
        LEFT JOIN 
            image i ON m.image_id = i.id
        WHERE 
            m.id = $id";

        $r = $this->bdd->requete($c,$query);
        
     
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }
   
    public function get_firstx_marques($x){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select  m.*,
                        i.lien AS image_lien
                    FROM 
                        marque m
                    LEFT JOIN 
                        image i ON m.image_id = i.id LIMIT $x";

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

                
        $this->bdd->deconnexion($c);
   
    }

    public function supprimer($id){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "DELETE FROM marque WHERE id =$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        

    }

    public function update($id,$marque,$imageId){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("UPDATE Marque SET
            nom = ?,
            pays_origine = ?,
            siege_social = ?,
            annee_creation = ?,
            lien = ?,
            image_id = ?
        WHERE id = ?");

        $query->bindParam(1, $marque['nom']);
        $query->bindParam(2, $marque['pays_origine']);
        $query->bindParam(3, $marque['siege_social']);
        $query->bindParam(4, $marque['annee_creation']);
        $query->bindParam(5, $marque['lien']);
        $query->bindParam(6, $imageId);
        $query->bindParam(7, $id);


        $query->execute();

    
                
        $this->bdd->deconnexion($c);
        


    }

    public function update_withoutimage($id,$marque){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("UPDATE Marque SET
            nom = ?,
            pays_origine = ?,
            siege_social = ?,
            annee_creation = ?,
            lien = ?
        WHERE id = ?");

        $query->bindParam(1, $marque['nom']);
        $query->bindParam(2, $marque['pays_origine']);
        $query->bindParam(3, $marque['siege_social']);
        $query->bindParam(4, $marque['annee_creation']);
        $query->bindParam(5, $marque['lien']);
        $query->bindParam(6, $id);


        $query->execute();

    
                
        $this->bdd->deconnexion($c);


    }

   

}


?>