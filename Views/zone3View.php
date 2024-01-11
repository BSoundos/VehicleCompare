<?php
// Les fichiers utilisés : 
require_once('Controller/comparaisonController.php');
require_once 'Controller/imageController.php';
require_once 'Controller/vehiculeController.php';
require_once 'Controller/versionController.php';
require_once 'Controller/modeleController.php';
require_once 'Controller/marqueController.php';

class zone3View {

    private $vehiculeController;
    private $versionController;
    private $imageController;
    private $modeleController;
    private $marqueController;

    public function __construct() {
        $this->vehiculeController = new Vehicule_controller();
        $this->versionController = new Version_controller();
        $this->imageController = new image_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new marqueController();
    }

    public function Zone3Display(){

       
        echo "<div class='zone3'>";
        
        echo "<div class='guide-button' >
            <button><a>Guide d'achat</a></button>
        </div>";


        $x = 3 ; // to get the first 3 popular
        $controller = new comparaison_controller();
        $r = $controller->get_firstx_comparaisons($x);


        echo "<div class='title'><h3>Comparaison populaires</h3></div>";
        echo "<div class='comparaison-populaires'><div class='slider'>";
       

        foreach($r as $row){
            echo"    
                       
                        <div class='cadre'>
                        <div class='nb-comparaison'>Comparés ".$row['nb']." fois</div> 
                        <div class='vehicules'>
                        ";

                        
                        $vehicule1 = $this->vehiculeController->get_vehicule_byId_controller($row['vehicule1']);
                        $vehicule1 = $vehicule1->fetch(PDO::FETCH_ASSOC);
                        $version1 = $this->versionController->get_version_byId_controller($vehicule1['version_id']);
                        $version1 = $version1->fetch(PDO::FETCH_ASSOC);
                        
                        $modele1 = $this->modeleController->get_modele_byId_controller($version1['modele_id']);
                        $modele1 = $modele1->fetch(PDO::FETCH_ASSOC);
                        $marque1 = $this->marqueController->get_marque_byId_controller($modele1['marque_id']);
                        $marque1 = $marque1->fetch(PDO::FETCH_ASSOC);
                        $this->displayVehicule_byId($vehicule1,$version1,"item1");

                        echo "<p>Vs</p>";

                        $vehicule2 = $this->vehiculeController->get_vehicule_byId_controller($row['vehicule2']);
                        $vehicule2 = $vehicule2->fetch(PDO::FETCH_ASSOC);
                        $version2 = $this->versionController->get_version_byId_controller($vehicule2['version_id']);
                        $version2 = $version2->fetch(PDO::FETCH_ASSOC);
                        $modele2 = $this->modeleController->get_modele_byId_controller($version2['modele_id']);
                        $modele2 = $modele2->fetch(PDO::FETCH_ASSOC);
                        $marque2 = $this->marqueController->get_marque_byId_controller($modele2['marque_id']);
                        $marque2 = $marque2->fetch(PDO::FETCH_ASSOC);
                        $this->displayVehicule_byId($vehicule2,$version2,"item2");


            echo"</div>
            
            <div class='comparer-button' >

            <!--pass the two params with in the url -->
            <button><a href='index.php?action=comparateur&compare=true&version1=".$version1['id']."&modele1=".$modele1['id']."&marque1=".$marque1['id']."&version2=".$version2['id']."&modele2=".$modele2['id']."&marque2=".$marque2['id']."'>Comparer</a></button>
            </div>
            </div>";
        }
        echo "</div></div>
        ";

      
       
     
    }


    public function displayVehicule_byId($vehicule,$version,$className){
            
            echo "
            <div class='$className'>";

            $image = $this->imageController->get_image_controller($vehicule["image_id"]);
            $image = $image->fetch(PDO::FETCH_ASSOC);
            echo  "<a href=''><img src=" . $image["lien"] . "></a>";

                        echo"
                        <p>" .$vehicule['nom'] . "".$version['annee']."</p>
                        
                        

                    </div>
                
                ";
    }
       
    

}


?>