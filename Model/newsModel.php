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
        
        $query = "SELECT news.*, Image.lien AS image_lien
        FROM news
        LEFT JOIN Image ON news.image_id = Image.id";

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
        
        $query = "SELECT news_details.*, Image.lien AS image_lien
        FROM news_details
        LEFT JOIN Image ON news_details.image_id = Image.id where news_id=$newsId";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_all_news_details(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT news_details.*, Image.lien AS image_lien
        FROM news_details
        LEFT JOIN Image ON news_details.image_id = Image.id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    

   
   

}


?>