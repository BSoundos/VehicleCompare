<?php

// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/conseilController.php');

class GuideView {

    private $acceuil_controller ;
    private $vehicule_controller ; 
    private $guide_controller ; 

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->guide_controller = new ConseilController();
    }

    public function guideDisplay(){
        // infos personnelle 
        echo"<!DOCTYPE html>
        <html>";


        $this->acceuil_controller->head();
        echo"<body>";
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();


        $r = $this->guide_controller->getAllConseils();
        echo "<div class='news-container'>";

        foreach($r as $row){
            
            echo "<div class='news-item' >";
            echo "<div class='paragraph-content'><h3>".$row['titre']."</h3>";
            echo "<p>Contenu : ".$row['contenu']."</p></div>";
          
            echo  '<div class="image"><img src='.$row["image_lien"].' ></div></div>';
        }

        echo "</div>";


        $this->acceuil_controller->footer();

        echo "</body></html>";



    }


}

?>