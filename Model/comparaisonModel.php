<?php
require_once 'connexionModel.php';

class comparaison_model {

    private $bdd ; 

    public function get_Comparaisons(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from comparaison";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_comparaison_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from comparaison where id=$id";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_firstx_comparaisons($x){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from comparaison order by nb desc LIMIT $x";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }
  
    public function get_comparaison_byVehiculeId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from comparaison where vehicule1=$id or vehicule2=$id LIMIT 3";

        $r = $this->bdd->requete($c,$query);
        
       
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function exist($x,$y){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT * FROM comparaison WHERE (vehicule1=$x AND vehicule2=$y) OR (vehicule1=$y AND vehicule2=$x) ";

        $result = $this->bdd->requete($c, $query);
        
        $this->bdd->deconnexion($c);
        return $result ; 

    }

    public function update_comparaison($x,$y){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
 
        $updateQuery = "UPDATE comparaison SET nb = nb + 1 WHERE (vehicule1=$x AND vehicule2=$y) OR (vehicule1=$y AND vehicule2=$x) ";
        $r = $this->bdd->requete($c, $updateQuery);
           

        $this->bdd->deconnexion($c);
        return $r ; 

    }

    public function insert_comparaison($x,$y){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
            
        $insertQuery = "INSERT INTO comparaison (vehicule1, vehicule2, nb) VALUES ($x, $y, 1)";
        $r = $this->bdd->requete($c, $insertQuery);

        $this->bdd->deconnexion($c);
        return $r ; 

    }

   

}


?>