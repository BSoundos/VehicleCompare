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

}


?>