<?php
require_once 'connexionModel.php';

class vehicule_model {

    private $bdd ; 

    public function get_vehicules(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from vehicule";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_vehicule_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from vehicule where id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_vehicule_byVersionId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from vehicule where version_id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_vehicule_byMarqueId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "
                SELECT
                    V.id AS vehicule_id,
                    V.nom AS vehicule_nom,
                    V.categorie,
                    V.annee AS vehicule_annee,
                    V.note,
                    V.tarif,
                    V.dimensions,
                    V.moteur,
                    V.puissance,
                    V.consommation,
                    V.capacite,
                    V.autre_performances,
                    I.id AS image_id,
                    I.lien AS image_lien,
                    VS.nom AS version_nom,
                    MO.nom AS modele_nom,
                    M.nom AS marque_nom
                FROM Vehicule V
                LEFT JOIN Image I ON V.image_id = I.id
                LEFT JOIN Version VS ON V.version_id = VS.id
                LEFT JOIN Modele MO ON VS.modele_id = MO.id
                LEFT JOIN Marque M ON MO.marque_id = M.id
                WHERE M.id = $id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

   
  

}


?>