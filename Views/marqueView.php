<?php
// Les fichiers utilisés :
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');

class marqueView {

    private $acceuil_controller ;
    private $news_controller ; 
    private $image_controller ; 
    private $marque_controller;
    private $modele_controller;
    private $vehicule_controller;
    private $avisController;

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->news_controller = new newsController();
        $this->image_controller = new image_controller();
        $this->marque_controller = new marqueController();
        $this->modele_controller = new Modele_controller();
        $this->vehicule_controller = new Vehicule_controller();
        $this->avisController = new avisController();
    }

    // pour la page des marques 
    public function marquesDisplay(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();
        
        
        $r = $this->marque_controller->get_Marques_controller();
        $result = $r->fetchAll(PDO::FETCH_ASSOC);

        
        echo"
        
        <div class='zone1'>";

       
        foreach($result as $row){

            echo " <div class='marque'>";
            echo  '<a href="index.php?action=marques&id='.$row['id'].'"><img src='.$row["image_lien"].' ></a>';
            echo  '<h4>'.$row["nom"].'</h4></div>';
        }
                

        
        $this->acceuil_controller->footer();

        echo "</div></body></html>";

    }

    public function principalVehicules($id){

        // will be changed to only principal=True
        $r = $this->vehicule_controller->get_vehicule_byMarqueId_controller($id); 
        foreach($r as $row){

            echo " <div class='marque'>";
            echo  '<a href="index.php?action=vehicules&id='.$row['vehicule_id'].'"><img src='.$row["image_lien"].' ></a>';
            echo  '<a href="index.php?action=vehicules&id='.$row['vehicule_id'].'"><h4>'.$row["vehicule_nom"].'</h4></a></div>';
        }

    }

    public function toutesVehicules($id){


        $result = $this->vehicule_controller->get_vehicule_byMarqueId_controller($id);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        echo " <script>
        let vehicules = [];    
        vehicules.push(".json_encode($result)."); 
        </script>";


        echo '<div class="centered"><select id="toutes-vehicules">
        <option value="" selected disabled>Choisissez une voiture</option>';
 
        foreach($result as $row){
            echo  '<option value='.$row['vehicule_id'].'>'.$row["vehicule_nom"].'</option>';
        }

        echo '</select></div>';

        echo"<div id='vehicule-spec'></div>";
        


        echo "
        <script> 
            document.getElementById('toutes-vehicules').addEventListener('change', displayDetails);

            function displayDetails() {

                let Id = this.value;
                console.log('Select on change',Id);
                
                let data = vehicules[0].filter(entry => String(entry.vehicule_id) === String(Id));

                console.log('data',data);


                let details = '';
                
                if(Id) {
                details = '<h2><a href=' + 'index.php?action=vehicules&id=' +data[0]['vehicule_id']+'> '+ data[0]['vehicule_nom']+ '</a></h2>';
                details += '<p> Modele : ' + data[0]['modele_nom'] +'</p>';
                details += '<p>Marque :  ' + data[0]['marque_nom'] + '</p>';
                details += '<p>Version:  '+data[0]['version_nom']+'</p>';
                details += '<p>Année :  ' + data[0]['vehicule_annee'] + '</p>';
                details += '<p>Dimensions :  ' + data[0]['dimensions'] + '</p>';
                details += '<p>Consommation :  ' + data[0]['consommation'] + ' L/100km</p>';
                details += '<p>Moteur :  ' + data[0]['moteur'] + '</p>';
                details += '<p>Puissance :  ' + data[0]['puissance'] + ' ch</p>';
                details += '<p>Transmission :  ' + data[0]['autre_performances'] + '</p>'; 
                details += '<p>Places :  ' + data[0]['capacite'] + '</p>';
                details += '<p>Catégorie :  ' + data[0]['categorie'] + '</p>';
                details += '<p>Note :  ' + data[0]['note'] + '/5</p>';
                details += '<p>Prix :  ' + data[0]['tarif'] + ' DA</p>';
                }
                
                document.getElementById('vehicule-spec').innerHTML = details;
                
            }
        </script>
        ";

    }



    // pour la page des détails d'une marque 
    public function marqueDetailsDisplay($id){

        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();


        $r = $this->marque_controller->get_marque_byId_controller($id);
        $marqueData = $r->fetch(PDO::FETCH_ASSOC);

        echo "<div class='marques-details'>
        <h3>Les informations générales sur la marque :</h3>";
        echo "<ul>";
        echo "<li><strong>Nom:</strong> " . $marqueData["nom"] . "</li>";
        echo "<li><strong>Pays d'origine:</strong> " . $marqueData["pays_origine"] . "</li>";
        echo "<li><strong>Siège social:</strong> " . $marqueData["siege_social"] . "</li>";
        echo "<li><strong>Année de création:</strong> " . $marqueData["annee_creation"] . "</li>";
        echo "<li><strong>Lien:</strong> <a href='" . $marqueData["lien"] . "'>" . $marqueData["lien"] . "</a></li>";
        echo "</ul>";

        echo "</div>";

        echo"<div class='principales-voitures' >
        <h3>Les principales voitures :</h3>
        ";
        $this->principalVehicules($id);
        echo"</div>";

        echo"<div class='liste-voitures' >
        <h3>Toutes les voitures :</h3>";
        $this->toutesVehicules($id);
        echo"</div>";


        
        // avis Zone *******************
        $this->avisController->avisDisplay2part($id,1);
        

        
        $this->acceuil_controller->footer();
        
        echo"</body></html>";

    }
   
}
?>
