<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');
require_once('Controller/adminManageController.php');
require_once('Controller/vehiculeController.php');
require_once 'Controller/imageController.php';
require_once 'Controller/versionController.php';
require_once 'Controller/modeleController.php';
require_once 'Controller/marqueController.php';


class modifView {

    private $acceuil_controller ;
    private $admin_controller ;
    private $vehicule_controller;

    private $version_controller ; 
    private $image_controller ; 

    private $modeleController;
    private $marqueController;

    private $adminManageController;

    private $marques;
    private $modeles;
    private $versions;


    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->image_controller = new image_controller();
        $this->version_controller = new Version_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new marqueController();

        $this->adminManageController = new adminManageController();


        $this->marques = $this->marqueController->get_Marques_controller();
        $this->modeles = $this->modeleController->get_Modeles_controller();
        $this->versions = $this->version_controller->get_versions_controller();
    }


    public function modifDisplay($var,$id){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        echo "<div class='ajout-container'>
        <h2>Modifier $var</h2>
        <form action='index.php?action=admin&page=$var' method='post' enctype='multipart/form-data'>";

        switch($var){
            case 'marque':

                $result = $this->marqueController->get_marque_byId_controller($id);
                $result = $result->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    foreach ($row as $field => $value) {
                        if ($field === 'id') {
                            echo "<input type='hidden' name='id' value='".$value."'  >  ";
                        }
                        else if ($field === 'image_id') {
                            echo "<label for='image'>Image:</label>
                            <label><img src='".$row['image_lien']."' style='width: 120px;' ></label>
                            <input type='file' id='image' name='image' >";
                        }
                        else {
                            echo "<label for=".$field.">".$field.":</label>
                            <input type='text' id=".$field." name=".$field." value='".$value."'  required>";
                        }
        
                    }
                }
                break;
            
        }

        echo "<button name='submit' type='submit'>Submit</button>
        </form></div>"; 

        //$this->acceuil_controller->footer();

        echo "</div></body></html>";
    }

    public function formDisplay($id){

        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $result = $this->vehicule_controller->get_vehicule_andids($id);
        $result = $result->fetch(PDO::FETCH_ASSOC);


        echo "
        <div class='ajout-container'>
            <h2>Modifier Vehicule</h2>
            <form action='index.php?action=admin&page=vehicule&id_marque=".$result['marque_id']."' method='post' enctype='multipart/form-data'>
                <input type='hidden' name='id' value='".$result['id']."'  >  
            
                <label for='nom'>Nom:</label>
                <input type='text' id='nom' name='nom' value='".$result['nom']."' required>
        

                <label for='categorie'>Catégorie:</label>
                <select id='categorie' name='categorie'>
                    <option value='Voiture' selected >Voiture</option>
                    <option value='Motocyclette'>Motocyclette</option>
                    <option value='Vélo'>Vélo</option>
                </select>

                <label for='marque'>Marque:</label>
                <select id='marque' name='marque_id'>";
                   
                foreach($this->marques as $row){
                    if ($result['marque_id']===$row['id']) {
                        echo"<option value=".$row['id']."  selected   >".$row['nom']."</option>";
                    }
                    else {echo"<option value=".$row['id']." >".$row['nom']."</option>";}
                }
    
                echo"</select>
                <label><a href='index.php?action=admin&page=marque&tache=ajout'>Ajouter une marque ?</a></label>


                <label for='modele'>Modèle:</label>
                <select id='modele' name='modele_id'>";
                   
                foreach($this->modeles as $row){
                    if ($result['modele_id']===$row['id']) {
                        echo"<option value=".$row['id']."  selected   >".$row['nom']."</option>";
                    }
                    else {
                    echo"<option value=".$row['id'].">".$row['nom']."</option>";}
                }
    
                echo"
                  
                </select><label><a href='index.php?action=admin&page=modele&tache=ajout'>Ajouter un modéle ?</a></label>

                <label for='version'>Version:</label>
                <select id='version' name='version_id'>";
                   
                foreach($this->versions as $row){
                    if ($result['version_id']===$row['id']) {
                        echo"<option value=".$row['id']."  selected   >".$row['nom']."</option>";
                    }
                    else {
                    echo"<option value=".$row['id'].">".$row['nom']."</option>";}
                }
    
                echo"
                 
                </select><label><a href='index.php?action=admin&page=version&tache=ajout'>Ajouter une version ?</a></label>

                
                <label for='image'>Image:</label>
                <label><img src='".$result['image_lien']."' style='width: 120px;' ></label>
                <input type='file' id='image' name='image'>

                <label for='annee'>Annee:</label>
                <input type='text' id='annee' name='annee' value='".$result['annee']."' required>

                <label for='tarif'>Tarif:</label>
                <input type='text' id='tarif'  name='tarif'  value='".$result['tarif']."'>
        
                <label for='dimensions'>Dimensions:</label>
                <input type='text' id='dimensions' name='dimensions' value='".$result['dimensions']."'>

                <label for='moteur'>Moteur:</label>
                <input type='text' id='moteur' name='moteur' value='".$result['moteur']."'>

                <label for='puissance'>Puissance:</label>
                <input type='text' id='puissance' name='puissance' value='".$result['puissance']."'>

                <label for='consommation'>Consommation:</label>
                <input type='text' id='consommation' name='consommation' value='".$result['consommation']."'>

                <label for='capacite'>Capacité:</label>
                <input type='text' id='capacite' name='capacite' value='".$result['capacite']."'>

                <label for='autre_performances'>Autres performances:</label>
                <input type='text' id='autre_performances' name='autre_performances' value='".$result['autre_performances']."'>
                
        
                <button name='submit' type='submit'>Submit</button>
            </form>
        </div>
        ";

        
        
         //$this->acceuil_controller->footer();

         echo "</div></body></html>";

    }

  

}

?>