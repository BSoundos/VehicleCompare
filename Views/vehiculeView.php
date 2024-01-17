<?php
// Les fichiers utilisés :
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');


class vehiculeView {

    private $acceuil_controller ;
    private $vehicule_controller ; 
    private $version_controller ; 
 

    private $modeleController;
    private $marqueController;
    private $avisController;

    private $admin_controller ;

    
    public function __construct() {
        $this->admin_controller = new adminController();
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
      
        $this->version_controller = new Version_controller();
        $this->comparaison_controller = new Comparaison_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new marqueController();
        $this->avisController = new avisController();
    }



    public function vehicule_details($result){

        echo "<div class='vehicule_details'>";
            echo "<h2>".$result['nom']."</h2>"; 
         
            echo '<img src='.$result["image_lien"].' >';
    
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


        if (isset($_SESSION['authenticated']) && ($_SESSION['authenticated']) ) {

       
        $id_user = $_SESSION['id'] ; 
        $r = $this->vehicule_controller->getFavoris($id,$id_user);
        $r = $r->fetch(PDO::FETCH_ASSOC);


        if ($r){
        echo "<div class='centered'><button id='favorisSupp'><img src='img/rem_fav.png'></button></div>";
        echo "<div class='centered'><button style='display: none;' id='favoris'><img src='img/add_fav.png'></button></div>";
        }else {
        echo "<div class='centered'><button id='favoris'><img src='img/add_fav.png'></button></div>";
        echo "<div class='centered'><button style='display: none;' id='favorisSupp'><img src='img/rem_fav.png'></button></div>";
        }

        echo "
        <script>
        $(document).ready(function() {
            function updateButtons(isFavorite) {
                if (isFavorite) {
                    $('#favorisSupp').show();
                    $('#favoris').hide();
                } else {
                    $('#favorisSupp').hide();
                    $('#favoris').show();
                }
            }
        
       
           
        
            $('#favoris').click(function() {
                $.ajax({
                    url: 'index.php?action=profile',
                    type: 'GET',
                    data: { vehicule_id : ".json_encode($id)." , add: 1 },
                    success: function(response) {
                        // Update buttons after successful addition
                        updateButtons(true);
                    }
                });
            });
        
            $('#favorisSupp').click(function() {
                $.ajax({
                    url: 'index.php?action=profile',
                    type: 'GET',
                    data: { vehicule_id : ".json_encode($id)." , supp: 1 },
                    success: function(response) {
                        // Update buttons after successful removal
                        updateButtons(false);
                    }
                });
            });
        });
        
        </script>";
      
        }


        // avis Zone *******************
        $this->avisController->avisDisplay2part($result['id'],0);
      

        

        $r = $this->comparaison_controller->get_comparaison_byVehiculeId($result["id"]);
        $result2 = $r->fetchAll(PDO::FETCH_ASSOC);
     
        // comp populaires Zone *******************
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

                        
                        $req1 = $this->vehicule_controller->get_vehicule_andids($row['vehicule1']);
                        $vehicule1 = $req1->fetch(PDO::FETCH_ASSOC);
                      
                        $version1 = $this->version_controller->get_version_byId_controller($vehicule1['version_id']);
                        $version1 = $version1->fetch(PDO::FETCH_ASSOC);
                        
                        $modele1 = $vehicule1['modele_id'];
                       
                        $marque1 = $vehicule1['marque_id'];
                   
                        $this->acceuil_controller->displayVehicule_byId($vehicule1,$version1,"item1");

                        echo "<p>Vs</p>";

                        
                        if($row["vehicule2"] === $result['id'] ){
                            $vehicule2 = $this->vehicule_controller->get_vehicule_andids($row['vehicule1']);
                        }
                        else {
                            $vehicule2 = $this->vehicule_controller->get_vehicule_andids($row['vehicule2']);
                        }
                        
                        $vehicule2 = $vehicule2->fetch(PDO::FETCH_ASSOC);
                        
                        $version2 = $this->version_controller->get_version_byId_controller($vehicule2['version_id']);
                        $version2 = $version2->fetch(PDO::FETCH_ASSOC);
                        
                        $modele2 = $vehicule2['modele_id'];
                       
                        $marque2 = $vehicule2['marque_id'];
                        
                        $this->acceuil_controller->displayVehicule_byId($vehicule2,$version2,"item2");


            echo"</div>
            
            <div class='comparer-button' >
            <!--pass the two params with in the url -->
            <button><a href='index.php?action=comparateur&compare=true&version1=".$version1['id']."&modele1=".$modele1."&marque1=".$marque1."&version2=".$version2['id']."&modele2=".$modele2."&marque2=".$marque2."'>Comparer</a></button>
            </div>

            </div>";
        }
        echo "</div></div></div>
        ";     

   



        $this->acceuil_controller->footer();

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

        $r = $this->vehicule_controller->get_vehicule_byId_controller($id);
        $result = $r->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            
            $this->vehicule_details($result);

        }

        $this->acceuil_controller->footer();

        echo "</div></body></html>";

    }

}
?>
