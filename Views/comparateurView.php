<?php
// Les fichiers utilisés :
require_once('Views/acceuilView.php');
require_once('Controller/vehiculeController.php');

class comparateurView {

    private $numVehicules;

    private $vehicules ;
    private $marques ;
    private $modeles ;
    private $versions ;

    private $images ;

    public function comparateurDisplay() {
        
        $acceuilView = new acceuilView();

        echo"<!DOCTYPE html>
        <html>";

        $acceuilView->head();
        $acceuilView->header();
        $acceuilView->Menu();
        echo"<section>";

        
        $acceuilView->Zone2();
        if (isset($_POST['submit'])) {
            $this->handleComparison();
        }

        $this->displayComparisonResults();
        
        echo"</section>";
        //$acceuilView->footer();
        echo"</body></html>";
    }

    private function handleComparison() {
        
        $c = new Vehicule_controller();
        $versionController = new Version_controller();
        $modeleController = new Modele_controller();
        $marqueController = new Marque_controller();
        $imageController = new image_controller(); 

        $this->vehicules = array();
        $this->marques = array();
        $this->modeles = array();
        $this->versions = array();
        $this->images = array();

        $this->numVehicules = 0;
        
        
        for ($i = 1; $i <= 4; $i++) {
            $marque = isset($_POST["marque$i"]) ? $_POST["marque$i"] : null;
            $modele = isset($_POST["modele$i"]) ? $_POST["modele$i"] : null;
            $version = isset($_POST["version$i"]) ? $_POST["version$i"] : null;
            
            if ($marque === null || $modele === null || $version === null) {
                // do nothing
            } 
            else {
                $this->numVehicules++;
                $vehicule = $c->get_vehicule_byVersionId_controller($version);
                $vehicule = $vehicule->fetch(PDO::FETCH_ASSOC);

                $image = $imageController->get_image_controller($vehicule["image_id"]);
                $imageData = $image->fetch(PDO::FETCH_ASSOC);
    

                $version = $versionController->get_version_byId_controller($version);
                $version = $version->fetch(PDO::FETCH_ASSOC);
                $modele = $modeleController->get_modele_byId_controller($modele);
                $modele = $modele->fetch(PDO::FETCH_ASSOC);
                $marque = $marqueController->get_marque_byId_controller($marque);
                $marque = $marque->fetch(PDO::FETCH_ASSOC);
                
                $this->vehicules[$i] = $vehicule;
                $this->marques[$i] = $marque;
                $this->modeles[$i] = $modele;
                $this->versions[$i] = $version;
                $this->images[$i] = $imageData["lien"];

            }
            
        }

    }

    private function displayComparisonResults() {
        
        echo '<p>numVehicules: '.$this->numVehicules.'</p>';
        echo '
            <table>
                <thead>
                    <tr>
                        <td></td>'; 

       
                        foreach ($this->vehicules as $vehicule) {
                            echo '<td>'.$vehicule['nom'].'</td>';
                       }

        echo '
                </tr>
                </thead>
                <tbody>';

        
        echo '
                    <tr id="image">
                        <td>Images</td>'; 

        
        foreach ($this->images as $imagesrc) {
             echo '<td><img src='.$imagesrc.' ></td>';
        }

        echo '</tr>';

        
        echo '
              <tr id="tarif">
                <td>Tarif</td>'; 

                foreach ($this->vehicules as $vehicule) {
                    echo '<td>'.$vehicule['tarif'].' DA </td>';
               }

        echo '</tr>';

        $var = $this->numVehicules+1 ;
        echo '
              <tr id="info">
                <td colspan='.$var.'> Informations pratiques </td> 
              </tr>';

        
        echo '
              <tr id="marque">
                <td>Marque</td>'; 

                foreach ($this->marques as $marque) {
                    echo '<td>'.$marque['nom'].'</td>';
               }

        echo '</tr>';    

        echo '
        <tr id="modele">
          <td>Modele</td>'; 

          foreach ($this->modeles as $modele) {
              echo '<td>'.$modele['nom'].'</td>';
         }

        echo '</tr>'; 

        echo '
        <tr id="version">
          <td>Version</td>'; 

          foreach ($this->versions as $version) {
              echo '<td>'.$version['nom'].'</td>';
         }

        echo '</tr>'; 

        echo '
        <tr id="annee">
          <td>Année</td>'; 

          foreach ($this->versions as $version) {
              echo '<td>'.$version['annee'].'</td>';
         }

        echo '</tr>'; 

        echo '
        <tr id="note">
          <td>Note</td>'; 

          foreach ($this->vehicules as $vehicule) {
              echo '<td>'.$vehicule['note'].'</td>';
         }

        echo '</tr>'; 

        $fields = [
            'dimensions',
            'moteur', 'puissance', 'consommation', 'capacite', 'autre_performances'
        ];
       
        echo '
              <tr id="info">
                <td colspan='.$var.'> Détails importants </td> 
              </tr>';


        foreach ($fields as $field) {
            echo "
                    <tr>
                    <td >".$field."</td>";
                        foreach ($this->vehicules as $vehicule) {
                            echo "<td>".$vehicule[$field]."</td>";
                        }

            echo '</tr>';
        }

        echo '
                </tbody>
            </table>';
        

    }
}
?>
