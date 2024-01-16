<?php
require_once 'connexionModel.php';

class ConseilModel {

    private $bdd ; 

    public function getAllConseils(){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "
            SELECT C.id , C.titre, C.contenu, I.lien AS image_lien
            FROM Conseil AS C
            JOIN Image AS I ON C.image_id = I.id
        ";

        $r = $this->bdd->requete($c, $query);
        
        $this->bdd->deconnexion($c);
        return $r; 
    }
}

?>
