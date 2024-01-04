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
    private $modeleController;
    private $marqueController;
    private $imageController;

    public function __construct() {
        $this->vehiculeController = new Vehicule_controller();
        $this->versionController = new Version_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new Marque_controller();
        $this->imageController = new image_controller();
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
        echo "<div class='comparaison-populaires'>";




        foreach($r as $row){
            echo"    
                        <div class='nb-comparaison'>Comparés ".$row['nb']." fois</div> 
                        <div class='comp-container'>
                        <div class='cadre'>
                
                            <div class='item0'> 
                
                            <p>Nom: </p>
                            <p>Version: </p>
                            <p>Modele: </p>
                            <p>Marque: </p>
                            <p>Categorie: </p>
                            <p>Annee: </p>
                            <p>Note: </p>
                            <p>Tarif: </p>
                            <p>Dimensions: </p>
                            <p>Moteur: </p>
                            <p>Puissance: </p>
                            <p>Consommation: </p>
                            <p>Capacite: </p>
                            <p>Autre Performances: </p>
                            </div>";
            $this->displayVehicule_byId($row['vehicule1'],"item1");
            $this->displayVehicule_byId($row['vehicule2'],"item2");
            echo"</div></div>";
        }
        echo "</div>";
       

        
        

     
    }

    public function displayVehicule_byId($id,$className){
            

            $vehicule = $this->vehiculeController->get_vehicule_byId_controller($id);
            $vehicule = $vehicule->fetch(PDO::FETCH_ASSOC);
            $version = $this->versionController->get_version_byId_controller($vehicule['version_id']);
            $version = $version->fetch(PDO::FETCH_ASSOC);
            $modele = $this->modeleController->get_modele_byId_controller($version['modele_id']);
            $modele = $modele->fetch(PDO::FETCH_ASSOC);
            $marque = $this->marqueController->get_marque_byId_controller($modele['marque_id']);
            $marque = $marque->fetch(PDO::FETCH_ASSOC);
                        
            echo "
            <div class='$className'>";

            $image = $this->imageController->get_image_controller($vehicule["image_id"]);
            $image = $image->fetch(PDO::FETCH_ASSOC);
            echo  "<a href=''><img src=" . $image["lien"] . "></a>";

                        echo"
                        <p>" . $vehicule['nom'] . "</p>
                        <p>".$version['nom']."</p>
                        <p>".$modele['nom']."</p>
                        <p>".$marque['nom']."</p>
                        <p>" . $vehicule['categorie'] . "</p>
                        <p>" . $vehicule['annee'] . "</p>
                        <p>" . $vehicule['note'] . "</p>
                        <p>" . $vehicule['tarif'] . "</p>
                        <p>" . $vehicule['dimensions'] . "</p>
                        <p>" . $vehicule['moteur'] . "</p>
                        <p>" . $vehicule['puissance'] . "</p>
                        <p>" . $vehicule['consommation'] . "</p>
                        <p>" . $vehicule['capacite'] . "</p>
                        <p>" . $vehicule['autre_performances'] . "</p>
                        ";
        

                        echo"
                        

                    </div>
                
                ";
    }
       
    

}


?>