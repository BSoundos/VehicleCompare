<?php
require_once 'connexionModel.php';

class version_model {

    private $bdd ; 

    public function get_Versions(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from version";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_version_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from version where id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_version_byModeleId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from version where modele_id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_modele_marque_byid($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT M.id AS marque_id, MO.id AS modele_id, V.id As version_id, V.annee As annee
                    FROM Version V
                    JOIN Modele MO ON V.modele_id = MO.id
                    JOIN Marque M ON MO.marque_id = M.id
                    WHERE V.id =$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 

    }

  

}


?>