<?php
require_once 'connexionModel.php';

class newsModel {

    private $bdd ; 

    public function get_Diaporama(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT news.*, Image.lien AS image_lien
        FROM news
        LEFT JOIN Image ON news.image_id = Image.id AND diapo=TRUE";

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
        
        $query = "SELECT news.*, Image.lien AS image_lien
        FROM news
        LEFT JOIN Image ON news.image_id = Image.id where news.id=$id";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_newsdetails_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT news_details.*, Image.lien AS image_lien
        FROM news_details
        LEFT JOIN Image ON news_details.image_id = Image.id where news_details.id=$id";

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


    public function update($id,$news,$imageId){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("UPDATE News SET
        titre = ?,
        date = ?,
        contenu = ?,
        lien = ?,
        image_id =?,
        WHERE id = ?");
    
        $query->bindParam(1, $news['titre']);
        $query->bindParam(2, $news['date']);
        $query->bindParam(3, $news['contenu']);
        $query->bindParam(4, $news['lien']);
        $query->bindParam(5, $imageId);
        $query->bindParam(6, $id);
    


        $query->execute();

    
                
        $this->bdd->deconnexion($c);
        


    }

    public function update_withoutimage($id,$news){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("UPDATE News SET
        titre = ?,
        date = ?,
        contenu = ?,
        lien = ?
        WHERE id = ?");
    
        $query->bindParam(1, $news['titre']);
        $query->bindParam(2, $news['date']);
        $query->bindParam(3, $news['contenu']);
        $query->bindParam(4, $news['lien']);
        $query->bindParam(5, $id);


        $query->execute();

    
                
        $this->bdd->deconnexion($c);


    }

    public function supprimer($id){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "DELETE FROM news WHERE id =$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 

    }
    

    //insert
    public function insert($marque,$imageId){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("INSERT INTO News
        (titre,date,contenu,lien,diapo,image_id)
        VALUES (?, ?, ?, ?, ?, ?)");

        $query->bindParam(1, $marque['titre']);
        $query->bindParam(2, $marque['date']);
        $query->bindParam(3, $marque['contenu']);
        $query->bindParam(4, $marque['lien']);
        $query->bindParam(5, $marque['diapo']);
        $query->bindParam(6, $imageId);


        $query->execute();

                
        $this->bdd->deconnexion($c);
   
    }


    public function updatedetails($id,$news,$imageId){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("UPDATE news_details SET
        text = ?,
        image_id =?
        WHERE id = ?");
    
        $query->bindParam(1, $news['text']);
        $query->bindParam(2, $imageId);
        $query->bindParam(3, $id);
    


        $query->execute();

    
                
        $this->bdd->deconnexion($c);
        


    }

    public function updatedetails_withoutimage($id,$news){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("UPDATE news_details SET
        text = ?
        WHERE id = ?");
    
        $query->bindParam(1, $news['text']);
        $query->bindParam(2, $id);


        $query->execute();

    
                
        $this->bdd->deconnexion($c);


    }

    public function supprimerdetails($id){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "DELETE FROM news_details WHERE id =$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 

    }
    

    //insert
    public function insertdetails($marque,$imageId){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("INSERT INTO news_details
        (news_id,text,image_id)
        VALUES (?, ?, ?)");

        $query->bindParam(1, $marque['news_id']);
        $query->bindParam(2, $marque['text']);
        $query->bindParam(3, $imageId);


        $query->execute();

                
        $this->bdd->deconnexion($c);
   
    }
   

}


?>