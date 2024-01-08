<?php
// Les fichiers utilisés :
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');

class vehiculeView {

    private $acceuil_controller ;
    private $vehicule_controller ; 
    private $version_controller ; 
    private $image_controller ; 

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->image_controller = new image_controller();
        $this->version_controller = new Version_controller();
    }

    public function vehiculeDetailsDisplay($id){

        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();

        $r = $this->vehicule_controller->get_vehicule_byId_controller($id);
        $result = $r->fetch(PDO::FETCH_ASSOC);

        if ($result) {
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


            $r = $this->version_controller->get_modele_marque_byid_controller($result["version_id"]); 
            $fields= $r->fetch(PDO::FETCH_ASSOC);

        }
        
    

        //$this->acceuil_controller->footer();
    
        
        echo"</body></html>";
    }

}
?>
