<?php
require_once 'connexionModel.php';

class LoginModel {

    private $bdd ; 

    public function get_user($username, $password){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = "select * from utilisateur where nom_utilisateur='$username' AND mot_de_passe='$password' ";

        $r = $this->bdd->requete($c,$query);
                
        $this->bdd->deconnexion($c);
        return $r;
    }


    public function register_user($user){
        $this->bdd = new connexion_model(); 
        $c = $this->bdd->connexion();
        
        $query = $c->prepare("INSERT INTO utilisateur
        (nom, prenom, sexe, date_de_naissance, nom_utilisateur, mot_de_passe, statut, role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

       
        $query->execute($user);

       
        $query = "SELECT * FROM utilisateur ORDER BY id DESC LIMIT 1";
        $r = $this->bdd->requete($c, $query);
                
        $this->bdd->deconnexion($c);
        return $r;      
    }


}


?>