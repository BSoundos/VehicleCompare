<?php
// Les fichiers utilisés :
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');
require_once('Views/zone3View.php');

class avisView {

    private $acceuil_controller ;
    private $vehicule_controller ; 
    private $version_controller ; 
    private $image_controller ; 

    private $modeleController;
    private $marqueController;
    private $avisController;

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->image_controller = new image_controller();
        $this->version_controller = new Version_controller();
        $this->comparaison_controller = new Comparaison_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new marqueController();
        $this->avisController = new avisController();
    }

    public function AvisDisplay($targetId,$type) {
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();

        $avis = $this->avisController->get_avis_byTargetId_controller($targetId,$type);
        $avis = $avis->fetchAll(PDO::FETCH_ASSOC);



    }

    public function avisDisplay2part($target_id,$type){
        // Les 3 avis les plus appréciés : 

        $x = 3 ; 
        $avis = $this->avisController->get_best_xavis_byTargetId_controller($x,$target_id,$type);
        $avis = $avis->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='avis-apprec'>
        <h3>Les 3 avis les plus appréciés</h3>";
        
        $x = 1 ; 
        foreach($avis as $row){

            echo "<div class='avis'>";
            echo "<h5>".$row['note']." / 5 : </h5><p>".$row['commentaire']."</p>";
            
            echo "</div>";

            $x++;
        }

        echo "<a href='index.php?action=avis&id=".$target_id."&type=0'>Voir toutes les avis</a>"; 
        echo"</div>";



        // Donner une note et un avis pour les utilisateurs connectés :
        if (isset($_SESSION['authenticated']) && ($_SESSION['authenticated']) ) {
            $id = $_SESSION['id'] ; 

            echo "<div class='avis-ajout'>";
            echo "
            <form method='POST' action='index.php?action=avis&id=".$target_id."&type=0'>
            <label for='rating'>Note (1-5):</label>
            <input type='number'  name='note' min='1' max='5' required>
            <br>

            <label for='review'>Avis:</label>
            <textarea name='commentaire' rows='4' required></textarea>
            <br>

            <input type='hidden' name='target_id' value=".$target_id."> 
            <input type='hidden' name='utilisateur_id' value=".$id."> ";
            
            if ($type===0) { // vehicule
                  echo"<button type='submit' name='vehiculeAvis'>Ajouter</button>";
            }
            else { // ==1 // marque 
                  echo"<button type='submit' name='marqueAvis'>Ajouter</button>";
            }
            

            echo"</form>
            ";

            echo "</div>";
        }


  }
}

