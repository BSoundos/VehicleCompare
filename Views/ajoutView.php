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
require_once 'Controller/avisController.php';
require_once 'Controller/utilisateurController.php';

class ajoutView {

    private $acceuil_controller ;
    private $admin_controller ;
    private $vehicule_controller;

    private $version_controller ; 
    private $image_controller ; 

    private $modeleController;
    private $marqueController;
    private $avisController;
    private $userController;

    private $adminManageController;

    private $marques;
    private $modeles;
    private $versions;
    private $targets;
    private $users;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->image_controller = new image_controller();
        $this->version_controller = new Version_controller();
        $this->modeleController = new Modele_controller();
        $this->marqueController = new marqueController();

        $this->adminManageController = new adminManageController();
        $this->avisController = new avisController();
        $this->userController = new userController();


        $this->marques = $this->marqueController->get_Marques_controller();
        $this->modeles = $this->modeleController->get_Modeles_controller();
        $this->versions = $this->version_controller->get_versions_controller();

        $this->users = $this->userController->get_users_controller();
        $this->targets = $this->vehicule_controller->get_Vehicules_controller(); // only vehicules
        
    }


    public function ajoutDisplay($var){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        echo "<div class='ajout-container'>
        <h2>Ajouter $var</h2>";
        echo"<form action='index.php?action=admin&page=$var' method='post' enctype='multipart/form-data'>";

        switch($var){
            case 'marque':

                $result = $this->marqueController->get_firstx_marques_controller(1);
                $result = $result->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($result as $row) {
                    foreach ($row as $field => $value) {
                        if ($field === 'id' || $field === 'image_lien' ) {
        

                        }
                        else if ($field === 'image_id') {
                            echo "<label for='image'>Image:</label>
                            <input type='file' id='image' name='image' required>";
                        }
                        else {
                            echo "<label for=".$field.">".$field.":</label>
                            <input type='text' id=".$field." name=".$field." required>";
                        }
        
                    }
                    echo "
                    <label><a href='index.php?action=admin&page=modele&tache=ajout'>Ajouter un modéle ?</a></label>
                    <label><a href='index.php?action=admin&page=version&tache=ajout'>Ajouter une version ?</a></label>";

                }
                break;

            case 'modele':

                    $result = $this->modeleController->get_Modeles_controller();
                    $result = $result->fetchAll(PDO::FETCH_ASSOC);
                  
                    foreach ($result as $row) {
                        foreach ($row as $field => $value) {
                            if ($field === 'id') {
    
                            }
                            else if ($field === 'marque_id') {
                                echo"<label for='marque'>Marque:</label>
                                    <select id='marque' name='marque_id'>";
                   
                                    foreach($this->marques as $row){
                                        echo"<option value=".$row['id'].">".$row['nom']."</option>";
                                    }
    
                                echo"</select>";

                            }
                            else {
                                echo "<label for=".$field.">".$field.":</label>
                                <input type='text' id=".$field." name=".$field." required>";
                            }
            
                        }
                        echo " <label><a href='index.php?action=admin&page=version&tache=ajout'>Ajouter une version ?</a></label>";
                        break;
                    }
                    break;

            case 'version':
                $result = $this->version_controller->get_versions_controller();
                $result = $result->fetchAll(PDO::FETCH_ASSOC);
                  
                    foreach ($result as $row) {
                        foreach ($row as $field => $value) {
                            if ($field === 'id') {
    
                            }
                            else if ($field === 'modele_id') {
                                echo "<label for='modele'>Modèle:</label>
                                <select id='modele' name='modele_id'>";
                                
                                foreach($this->modeles as $row){
                                    echo"<option value=".$row['id'].">".$row['nom']."</option>";
                                }
                    
                                echo"
                                
                                </select>";

                            }
                            else {
                                echo "<label for=".$field.">".$field.":</label>
                                <input type='text' id=".$field." name=".$field." required>";
                            }
            
                        }
                        break;
                    }
                break;

            case 'avis':
                $result = $this->avisController->get_avis_controller();
                $result = $result->fetchAll(PDO::FETCH_ASSOC);
               
                    foreach ($result as $row) {
                        foreach ($row as $field => $value) {
                            if ( $field === 'id' || $field === 'type' || $field === 'statut'){


                            }
                            else if ($field === 'note') {
                                echo "<label for=".$field.">".$field.":</label>
                                <input type='number' name='note' min='1' max='5' required>";

                            }
                            else if ($field === 'target_id') {
                                echo "<label for='target'>Vehicule:</label>
                                <select id='target' name='target_id'>";
                                
                                foreach($this->targets as $row){
                                    echo"<option value=".$row['id'].">".$row['nom']."</option>";
                                }
                    
                                echo"
                                
                                </select>";

                            }
                            else  if ($field === 'utilisateur_id') {
                                echo "<label for='utilisateur_id'>Utilisateur:</label>
                                <select id='utilisateur_id' name='utilisateur_id'>";
                                
                                foreach($this->users as $row){
                                    echo"<option value=".$row['id'].">".$row['nom_utilisateur']."</option>";
                                }
                    
                                echo"
                                
                                </select>";

                            }
                            else {
                                echo "<label for=".$field.">".$field.":</label>
                                <input type='text' id=".$field." name=".$field." required>";
                            }
            
                        }
                        break;
                    }
                break ;
        }

        echo "<button name='submit' type='submit'>Submit</button>
        </form></div>"; 

        //$this->acceuil_controller->footer();

        echo "</div></body></html>";
    }

    public function formDisplay($id_marque){

        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $modeles = $this->modeleController->get_modele_byMarqueId_controller($id_marque);
        $versions = $this->version_controller->get_version_byMarqueId_controller($id_marque);
       

        echo "
        <div class='ajout-container'>
            <h2>Ajouter Vehicule</h2>
            <form action='index.php?action=admin&page=vehicule&id_marque=".$id_marque."' method='post' enctype='multipart/form-data'>
                <label for='nom'>Nom:</label>
                <input type='text' id='nom' name='nom' required>
        
                <label for='categorie'>Catégorie:</label>
                <select id='categorie' name='categorie'>
                    <option value='Voiture'>Voiture</option>
                    <option value='Motocyclette'>Motocyclette</option>
                    <option value='Vélo'>Vélo</option>
                </select>

                <input type='hidden' id='id_marque' name='marque_id' value=".$id_marque."  required>

                <label for='modele'>Modèle:</label>
                <label><a href='index.php?action=admin&page=modele&tache=ajout'>Ajouter un modéle ?</a></label>
                <select id='modele' name='modele_id'>";
                   
                foreach($modeles as $row){
                    if ($result['modele_id']===$row['id']) {
                        echo"<option value=".$row['id']."  selected   >".$row['nom']."</option>";
                    }
                    else {
                    echo"<option value=".$row['id'].">".$row['nom']."</option>";}
                }
                echo "</select>

                
                <label for='version'>Version:</label>
                <select id='version' name='version_id'>";
                   
                foreach($versions as $row){
                    echo"<option value=".$row['id'].">".$row['nom']."</option>";
                }
    
                echo"
                 
                </select><label><a href='index.php?action=admin&page=version&tache=ajout'>Ajouter une version ?</a></label>

                <label for='image'>Image:</label>
                <input type='file' id='image' name='image' required>

                <label for='annee'>Annee:</label>
                <input type='text' id='annee' name='annee' required>

                <label for='tarif'>Tarif:</label>
                <input type='text' id='tarif' name='tarif'>
        
                <label for='dimensions'>Dimensions:</label>
                <input type='text' id='dimensions' name='dimensions'>

                <label for='moteur'>Moteur:</label>
                <input type='text' id='moteur' name='moteur'>

                <label for='puissance'>Puissance:</label>
                <input type='text' id='puissance' name='puissance'>

                <label for='consommation'>Consommation:</label>
                <input type='text' id='consommation' name='consommation'>

                <label for='capacite'>Capacité:</label>
                <input type='text' id='capacite' name='capacite'>

                <label for='autre_performances'>Autres performances:</label>
                <input type='text' id='autre_performances' name='autre_performances'>
                
        
                <button name='submit' type='submit'>Submit</button>
            </form>
        </div>
        ";

        
        
         //$this->acceuil_controller->footer();

         echo "</div></body></html>";

    }

  

}

?>