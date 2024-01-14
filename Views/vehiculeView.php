<?php
// Les fichiers utilisés :
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');
require_once('Views/zone3View.php');

class vehiculeView {

    private $acceuil_controller ;
    private $vehicule_controller ; 
    private $version_controller ; 
    private $image_controller ; 

    private $modeleController;
    private $marqueController;
    private $avisController;

    private $admin_controller ;

    
    public function __construct() {
        $this->admin_controller = new adminController();
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->image_controller = new image_controller();
        $this->version_controller = new Version_controller();
        $this->comparaison_controller = new Comparaison_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new marqueController();
        $this->avisController = new avisController();
    }



    public function vehicule_details($result){

        echo "<div class='vehicule-details'>";
            echo "<h2>".$result['nom']."</h2>"; 
            $image = $this->image_controller->get_image_controller($result["image_id"]);
            $imageData = $image->fetch(PDO::FETCH_ASSOC);

            echo '<img src='.$imageData["lien"].' >';
    
            foreach ($result as $field => $value) {
                if ($field !== 'image_id' && $field !== 'version_id' && $field !== 'id'  && $field !== 'nom') {
                    echo "<p><strong>".$field.":</strong> ".$value."</p>";
                }
            }

    
        echo "</div>";

    
    }

    public function avisDisplay($target_id,$type){
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
    
    public function vehiculeDetailsDisplay($id){


        $zone3View = new zone3View();

        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();


        

        $r = $this->vehicule_controller->get_vehicule_byId_controller($id);
        $result = $r->fetch(PDO::FETCH_ASSOC); // this vehicule 

        if ($result) {
            
            $this->vehicule_details($result);

            $r = $this->version_controller->get_modele_marque_byid_controller($result["version_id"]); 
            $fields= $r->fetch(PDO::FETCH_ASSOC);
        }

        $this->acceuil_controller->zone2(1,$fields["version_id"],$fields["modele_id"],$fields["marque_id"]);



        // avis Zone *******************
        $this->avisController->avisDisplay2part($result['id'],0);
      

        

        $r = $this->comparaison_controller->get_comparaison_byVehiculeId($result["id"]);
        $result2 = $r->fetchAll(PDO::FETCH_ASSOC);






        echo "<div class='zone3'>
        <div class='title'><h3>Comparaison populaires</h3></div>";
        echo "<div class='comparaison-populaires'>
        <div class='slider'>";
       

        foreach($result2 as $row){
            echo"    
                       
                        <div class='cadre'>
                        <div class='nb-comparaison'>Comparés ".$row['nb']." fois</div> 
                        <div class='vehicules'>
                        ";

                        
                        $vehicule1 =$this->vehicule_controller->get_vehicule_byId_controller($result['id']);
                        $vehicule1 = $vehicule1->fetch(PDO::FETCH_ASSOC);
                        $version1 = $this->version_controller->get_version_byId_controller($vehicule1['version_id']);
                        $version1 = $version1->fetch(PDO::FETCH_ASSOC);
                        
                        $modele1 = $this->modeleController->get_modele_byId_controller($version1['modele_id']);
                        $modele1 = $modele1->fetch(PDO::FETCH_ASSOC);
                        $marque1 = $this->marqueController->get_marque_byId_controller($modele1['marque_id']);
                        $marque1 = $marque1->fetch(PDO::FETCH_ASSOC);
                        $zone3View->displayVehicule_byId($vehicule1,$version1,"item1");

                        echo "<p>Vs</p>";

                        
                        if($row["vehicule2"] === $result['id'] ){
                            $vehicule2 = $this->vehicule_controller->get_vehicule_byId_controller($row['vehicule1']);
                        }
                        else {
                            $vehicule2 = $this->vehicule_controller->get_vehicule_byId_controller($row['vehicule2']);
                        }
                        
                        
                        $vehicule2 = $vehicule2->fetch(PDO::FETCH_ASSOC);
                        $version2 = $this->version_controller->get_version_byId_controller($vehicule2['version_id']);
                        $version2 = $version2->fetch(PDO::FETCH_ASSOC);
                        $modele2 = $this->modeleController->get_modele_byId_controller($version2['modele_id']);
                        $modele2 = $modele2->fetch(PDO::FETCH_ASSOC);
                        $marque2 = $this->marqueController->get_marque_byId_controller($modele2['marque_id']);
                        $marque2 = $marque2->fetch(PDO::FETCH_ASSOC);
                        $zone3View->displayVehicule_byId($vehicule2,$version2,"item2");


            echo"</div>
            
            <div class='comparer-button' >
            <!--pass the two params with in the url -->
            <button><a href='index.php?action=comparateur&compare=true&version1=".$version1['id']."&modele1=".$modele1['id']."&marque1=".$marque1['id']."&version2=".$version2['id']."&modele2=".$modele2['id']."&marque2=".$marque2['id']."'>Comparer</a></button>
            </div>

            </div>";
        }
        echo "</div></div></div>
        ";     



        //$this->acceuil_controller->footer();

        echo "
        <script>
            let vehicule1 = " . json_encode($fields) . ";
                    
            let hiddenFieldset = document.getElementById('fieldset1');

            if (hiddenFieldset) {
                hiddenFieldset.style.display = 'none'; 
            }

            

        </script>
        ";
    
        
        echo"</body></html>";
    }



    public function vehiculeCaracDisplay($id){

        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();

        $r = $this->vehicule_controller->get_vehicule_byId_controller($id);
        $result = $r->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            
            $this->vehicule_details($result);

        }

        //$this->acceuil_controller->footer();

        echo "</div></body></html>";

    }

}
?>
