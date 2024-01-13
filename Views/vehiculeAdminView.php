<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');
require_once('Controller/vehiculeController.php');


class VehiculeAdminView {

    private $acceuil_controller ;
    private $admin_controller ;
    private $vehicule_controller;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->vehicule_controller = new Vehicule_controller();
    }

    public function vehiculeDisplay(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();

        echo "<div class='links' align='center'>
        <a href='index.php?action=admin&page=vehicule&tache=ajout'>Ajouter véhicule</a>
        <a href='index.php?action=admin&page=marque&tache=ajout'>Ajouter une marque</a>
        <a href='index.php?action=admin&page=modele&tache=ajout'>Ajouter un modéle</a>
        <a href='index.php?action=admin&page=version&tache=ajout'>Ajouter une version</a>
        
        </div>";

        $this->displayTable();


        
        //$this->acceuil_controller->footer();

        echo "</div></body></html>";
    }


    public function displayTable(){
        $r = $this->vehicule_controller->get_marque_modele_version_annee_controller(); 
        $r = $r->fetchAll(PDO::FETCH_ASSOC);



        // the table 
       echo "
       <div class='table-admin'>
            <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Version</th>
                    <th>Année</th>
                    <th>Caractéristiques</th>
                    <th>Administrer</th>
                </tr>
            </thead>
            <tbody>";

            foreach($r as $row){
            
                echo"
                    <tr>
                        <td><img src='".$row['lien']."' ></td>
                        <td>".$row['marque_nom']."</td>
                        <td>".$row['modele_nom']."</td>
                        <td>".$row['version_nom']."</td>
                        <td>".$row['vehicule_annee']."</td>
                        <td><a href='index.php?action=vehicules-carac&id=".$row['id']."'>Voir Caractéristiques</a></td>
                        <td> 
                        <a href='index.php?action=admin&page=vehicule&tache=modif&id=".$row['id']."' >Modifier véhicule</a>
                        <a href='index.php?action=admin&page=vehicule&tache=supp&id=".$row['id']."' >Supprimer véhicule</a>
                        <a href='index.php?action=admin&page=marque&tache=modif&id=".$row['id']."' >Modifier marque</a>
                        <a href='index.php?action=admin&page=marque&tache=supp&id=".$row['id']."' >Supprimer marque</a>
                        </td>
                
                    </tr>";

            }
                
            echo"
            </tbody>
            </table></div>";


        
    }

   

}

?>