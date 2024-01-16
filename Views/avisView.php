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

    private $all_avis;

    
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

    public function avisPageDisplay(){ // page 1 
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();
        
        
        $r = $this->marqueController->get_Marques_controller();
        $result = $r->fetchAll(PDO::FETCH_ASSOC);

        
        echo"
        
        <div class='zone1'>";

       
        foreach($result as $row){

            echo " <div class='marque'>";
            echo  '<a href="index.php?action=avis&marque_id='.$row["id"].'"><img src='.$row["image_lien"].' ></a>';
            echo  '<h4>'.$row["nom"].'</h4></div>';
        }
                

        
        //$this->acceuil_controller->footer();

        echo "</div></body></html>";

    }



    public function AvisDetailsDisplay($targetId,$type) {
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();

        $vehicule = $this->vehicule_controller->get_vehicule_byId_controller($targetId);
        $vehicule = $vehicule->fetch(PDO::FETCH_ASSOC);

        $avis = $this->avisController->get_avis_byTargetId_controller($targetId,$type);
        $avis = $avis->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='vehicule' >";

        echo "<p>".$vehicule['nom']."</p>";
        echo "<img src=".$vehicule['image_lien']." ><br>";
        echo "<a href='index.php?action=vehicules&id=".$vehicule['id']."'>Voir description de cette vehicule.</a>";

        echo"
        <div id='reviews-container' class='all-avis'>
    
        </div>
    
        <div id='pagination' class='pagination'>
      
        </div>
        ";
    

        echo"</div>";


        echo " 

        <script>
        function loadContent(pageNumber = 1) {
            $.ajax({
                url: 'index.php?action=avis&load=1',
                type: 'GET',
                data: {  avis:"; echo json_encode($avis); echo", page: pageNumber },
                success: function(response) {
                    $('#reviews-container').html(response);
                }
            });
    
            $.ajax({
                url: 'index.php?action=avis&page=1',
                type: 'GET',
                data: { avis:"; echo json_encode($avis); echo", page: pageNumber },
                success: function(response) {
                    $('#pagination').html(response);
                }
                
            });
        }
    
        
        loadContent();
        </script>

        ";
        //$this->acceuil_controller->footer();

        echo "</div></body></html>";


    }


    public function paginate(){

        $avis =  isset($_GET['avis']) ? $_GET['avis'] : [];

        $totalReviews = count($avis);

        // Define the number of reviews to show per page
        $reviewsPerPage = 5;

        // Calculate the total number of pages
        $totalPages = ceil($totalReviews / $reviewsPerPage);

        // Get the current page number from the query string
        $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

        // Display pagination links
        echo "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='javascript:void(0);' onclick='loadContent($i)'>$i</a> ";
        }
        echo "</div>";

       

    }



    public function load(){
  
        $avis =   isset($_GET['avis']) ? $_GET['avis'] : [];

        // Calculate the total number of reviews
        $totalReviews = count($avis);

        // Define the number of reviews to show per page
        $reviewsPerPage = 5;

        // Get the current page number from the query string
        $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the starting index for the reviews on the current page
        $startIndex = ($pageNumber - 1) * $reviewsPerPage;

        // Get the reviews for the current page
        $reviewsForPage = array_slice($avis, $startIndex, $reviewsPerPage);

        // Display the reviews for the current page
        echo "<div class='all-avis'>";
        foreach ($reviewsForPage as $row) {
            echo "<div class='avis'>";
            echo "<p> user_id : " . $row['utilisateur_id'] . "</p>";
            echo "<p> note : " . $row['note'] . "</p>";
            echo "<p> commentaire : " . $row['commentaire'] . "</p>";
            echo "</div>";
        }
        echo "</div>";


    }



    public function avisInsideDisplay($id_marque) { 
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();

        // Get all vehicules of marque 
        $r = $this->vehicule_controller->get_vehicule_byMarqueId_controller($id_marque);
        $result = $r->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='all-vehicules'>";

        foreach ($result as $row){
            echo "<div class='vehicule' >";

            echo "<p>".$row['vehicule_nom']."</p>";

            echo "<a href='index.php?action=avis&type=0&id=".$row['vehicule_id']."'><img src=".$row['image_lien']." ></a>";

            echo "</div>";

        }
        
        echo"</div>";


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

