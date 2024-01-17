<?php
require_once 'connexionModel.php';

class vehicule_model {

    private $bdd ; 

    public function get_vehicules(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select  v.*,
        i.lien AS image_lien
        FROM 
            vehicule v
        LEFT JOIN 
        image i ON v.image_id = i.id";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    public function get_vehicule_byId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT v.*, i.lien AS image_lien
        FROM vehicule v
        LEFT JOIN image i ON v.image_id = i.id
        WHERE v.id = $id";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }

    public function get_vehicule_byVersionId($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select  v.*,
        i.lien AS image_lien
        FROM 
            vehicule v
        LEFT JOIN 
        image i ON v.image_id = i.id where version_id=$id";

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

    public function get_principale_vehicule_byMarqueId($id){
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
                WHERE V.principale= 1 and M.id = $id";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }



    public function get_vehicule_andids($id){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "
        SELECT 
        v.id ,
        v.nom ,
        v.categorie,
        v.image_id ,
        v.annee,
        v.note,
        v.tarif,
        v.dimensions,
        v.moteur,
        v.puissance,
        v.consommation,
        v.capacite,
        v.autre_performances,
        v.version_id,
        m.id AS modele_id,
        marque.id AS marque_id,
        ve.id AS version_id,
        image.lien AS image_lien
    FROM 
        Vehicule v
    LEFT JOIN 
        Version ve ON v.version_id = ve.id
    LEFT JOIN 
        Modele m ON ve.modele_id = m.id
    LEFT JOIN 
        Marque marque ON m.marque_id = marque.id
    LEFT JOIN 
        Image image ON v.image_id = image.id
    WHERE 
        v.id = $id
    ";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }



    public function get_marque_modele_version_annee(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT
        Vehicule.id AS id,
        Image.lien AS image_lien,
        Marque.nom AS marque_nom,
        Marque.id AS marque_id,
        Modele.nom AS modele_nom,
        Version.nom AS version_nom,
        Vehicule.annee AS vehicule_annee
        FROM Vehicule
        JOIN Image ON Vehicule.image_id = Image.id
        JOIN Version ON Vehicule.version_id = Version.id
        JOIN Modele ON Version.modele_id = Modele.id
        JOIN Marque ON Modele.marque_id = Marque.id";

        $r = $this->bdd->requete($c,$query);
        
        
        $this->bdd->deconnexion($c);
        return $r ; 
    }


    public function get_modele_version_annee_bymarque($id_marque){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "SELECT
        Vehicule.id AS id,
        Image.lien AS image_lien,
        Marque.nom AS marque_nom,
        Marque.id AS marque_id,
        Modele.nom AS modele_nom,
        Version.nom AS version_nom,
        Vehicule.annee AS vehicule_annee
        FROM Vehicule
        JOIN Image ON Vehicule.image_id = Image.id
        JOIN Version ON Vehicule.version_id = Version.id
        JOIN Modele ON Version.modele_id = Modele.id
        JOIN Marque ON Modele.marque_id = Marque.id
        WHERE Marque.id = $id_marque"; 
    
    
        $r = $this->bdd->requete($c, $query);
        
        
        $this->bdd->deconnexion($c);
        return $r; 
    }
    



    public function insert($vehicule,$imageId){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("INSERT INTO vehicule
        (nom, categorie, image_id, annee, note, tarif, dimensions, moteur, puissance, consommation, capacite, autre_performances, version_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $query->bindParam(1, $vehicule['nom']);
        $query->bindParam(2, $vehicule['categorie']);
        $query->bindParam(3, $imageId);
        $query->bindParam(4, $vehicule['annee']);
        $query->bindParam(5, $vehicule['note']);
        $query->bindParam(6, $vehicule['tarif']);
        $query->bindParam(7, $vehicule['dimensions']);
        $query->bindParam(8, $vehicule['moteur']);
        $query->bindParam(9, $vehicule['puissance']);
        $query->bindParam(10, $vehicule['consommation']);
        $query->bindParam(11, $vehicule['capacite']);
        $query->bindParam(12, $vehicule['autre_performances']);
        $query->bindParam(13, $vehicule['version_id']);

        $query->execute();

       
        $query = "SELECT * FROM vehicule ORDER BY id DESC LIMIT 1";
        $r = $this->bdd->requete($c, $query);
                
        $this->bdd->deconnexion($c);
        return $r;      
    }


    public function supprimer($id){

        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();

        $query = "DELETE FROM vehicule WHERE id=$id";

        $r = $this->bdd->requete($c,$query);
        
        $this->bdd->deconnexion($c);
        return $r ; 

    }


    public function update($id,$vehicule, $imageId) {
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
    
        $query = $c->prepare("UPDATE vehicule SET
            nom = ?,
            categorie = ?,
            image_id = ?,
            annee = ?,
            note = ?,
            tarif = ?,
            dimensions = ?,
            moteur = ?,
            puissance = ?,
            consommation = ?,
            capacite = ?,
            autre_performances = ?,
            version_id = ?
        WHERE id = ?");
    
        $query->bindParam(1, $vehicule['nom']);
        $query->bindParam(2, $vehicule['categorie']);
        $query->bindParam(3, $imageId);
        $query->bindParam(4, $vehicule['annee']);
        $query->bindParam(5, $vehicule['note']);
        $query->bindParam(6, $vehicule['tarif']);
        $query->bindParam(7, $vehicule['dimensions']);
        $query->bindParam(8, $vehicule['moteur']);
        $query->bindParam(9, $vehicule['puissance']);
        $query->bindParam(10, $vehicule['consommation']);
        $query->bindParam(11, $vehicule['capacite']);
        $query->bindParam(12, $vehicule['autre_performances']);
        $query->bindParam(13, $vehicule['version_id']);
        $query->bindParam(14, $id); 
    
        $query->execute();

   
        $this->bdd->deconnexion($c);
       
    }
    

    public function update_withoutimage($id,$vehicule) {
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
    
        $query = $c->prepare("UPDATE vehicule SET
            nom = ?,
            categorie = ?,
            annee = ?,
            note = ?,
            tarif = ?,
            dimensions = ?,
            moteur = ?,
            puissance = ?,
            consommation = ?,
            capacite = ?,
            autre_performances = ?,
            version_id = ?
        WHERE id = ?");
    
        $query->bindParam(1, $vehicule['nom']);
        $query->bindParam(2, $vehicule['categorie']);
        $query->bindParam(3, $vehicule['annee']);
        $query->bindParam(4, $vehicule['note']);
        $query->bindParam(5, $vehicule['tarif']); // Corrected index
        $query->bindParam(6, $vehicule['dimensions']);
        $query->bindParam(7, $vehicule['moteur']);
        $query->bindParam(8, $vehicule['puissance']);
        $query->bindParam(9, $vehicule['consommation']);
        $query->bindParam(10, $vehicule['capacite']);
        $query->bindParam(11, $vehicule['autre_performances']);
        $query->bindParam(12, $vehicule['version_id']);
        $query->bindParam(13, $id);

    
        $query->execute();

   
        $this->bdd->deconnexion($c);
       
    }
    
   
  

}


?>