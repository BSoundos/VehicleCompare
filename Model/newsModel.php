<?php
require_once 'connexionModel.php';

class newsModel {

    private $bdd ; 

    public function get_Diaporama(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from news where diapo=TRUE";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    public function get_news(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from news";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    public function get_news_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from news where id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_news_details($newsId){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from news_details where news_id=$newsId";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    

   
   

}


?>