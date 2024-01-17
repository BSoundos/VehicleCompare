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

        $this->all_vehicules_todetails();


        $r = $this->guide_controller->getAllConseils();
        echo "<div class='news-container'>";

        foreach($r as $row){
            
            echo "<div class='news-item' >";
            echo "<div class='paragraph-content'><h3>".$row['titre']."</h3>";
            echo "<p> ".$row['contenu']."</p></div>";
          
            echo  '<div class="image"><img src='.$row["image_lien"].' ></div></div>';
        }

        echo "</div>";

       
        

        $this->acceuil_controller->footer();

        echo "</body></html>";



    }


    public function all_vehicules_todetails(){

        $result = $this->vehicule_controller->get_Vehicules_controller();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<div class="centered"><select id="toutes-vehicules" onchange="selectVehicle()">
        <option value="" selected disabled>Choisissez une voiture</option>';

        foreach ($result as $row) {
            echo  '<option value=' . $row['id'] . '>' . $row["nom"] . '</option>';
        }

        echo '</select></div>';

  
        echo '<script>
                function selectVehicle() {
                    var dropdown = document.getElementById("toutes-vehicules");
                    var selectedValue = dropdown.options[dropdown.selectedIndex].value;

                    // Simulate clicking on a link with the selected value (change the URL as needed)
                    window.location.href = "index.php?action=vehicules&id=" + selectedValue;
                }
            </script>';

    }

}

?>