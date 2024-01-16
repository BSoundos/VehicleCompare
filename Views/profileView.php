<?php

// Les fichiers utilisés : 
require_once('Views/acceuilView.php');
require_once('Views/zone1View.php');
require_once('Views/zone2View.php');
require_once('Views/zone3View.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/utilisateurController.php');

class ProfileView {

    private $acceuil_controller ;
    private $vehicule_controller ; 
    private $user_controller ; 

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->user_controller = new userController();
    }

    public function profileDisplay($id){
        // infos personnelle 
        echo"<!DOCTYPE html>
        <html>";


        $this->acceuil_controller->head();
        echo"<body>";
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();


        $r = $this->user_controller->get_user_byID($_SESSION['id']);
        $r = $r->fetch(PDO::FETCH_ASSOC);


        echo "<div class='infos'>";

        echo "<p>username : ".$r['nom_utilisateur']." </p>";
        echo "<p>nom : ".$r['nom']."</p>";
        echo "<p>prenom : ".$r['prenom']."</p>";


        echo "</div>";



        $r = $this->vehicule_controller->getFavoris_byUserID($id);
        $r = $r->fetchAll(PDO::FETCH_ASSOC);


        echo "<div class='favoris-vehicules'>";
        foreach ($r as $row){
            echo "<div class='vehicule' >";

            echo "<p>".$row['nom']."</p>";
            echo "<img src=".$row['image_lien']." ><br>";
            echo "<a href='index.php?action=vehicules&id=".$row['id']."'>Voir description de cette vehicule.</a>";
    
            echo"</div>";

        }
        echo "</div>";



        //$this->acceuil_controller->footer();

        echo "</body></html>";



    }


}

?>