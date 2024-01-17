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


    public function vehiculeDisplay($id_marque){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();


        echo"<div class='links' align='center'>
        <a href='index.php?action=admin&page=vehicule&tache=ajout&id_marque=$id_marque'>Ajouter véhicule</a>
        </div>";
        

        $this->displayTable($id_marque);

        $this->admin_controller->jQueryForTables();
        


        
        

        echo "</div></body></html>";
    }


    public function displayTable($id_marque){
        $r = $this->vehicule_controller->get_modele_version_annee_controller_bymarque($id_marque); 
        $r = $r->fetchAll(PDO::FETCH_ASSOC);

        // the table 
       echo "
       <div class='table-admin'>
            <table id='myTable'>
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
                        <td><img src='".$row['image_lien']."' ></td>
                        <td>".$row['marque_nom']."</td>
                        <td>".$row['modele_nom']."</td>
                        <td>".$row['version_nom']."</td>
                        <td>".$row['vehicule_annee']."</td>
                        <td><a href='index.php?action=vehicules-carac&id=".$row['id']."'>Voir Caractéristiques</a></td>
                        <td> 
                        <a href='index.php?action=admin&page=vehicule&tache=modif&id=".$row['id']."' ><img src='img/edit.png'></a>
                        <a id='deleteLink'  href='index.php?action=admin&page=vehicule&tache=supp&id=".$row['id']."&id_marque=$id_marque' ><img  onclick='showConfirmation()'  src='img/delete.png'></a>
                        </td>
                
                    </tr>";

            }
                
            echo"
            </tbody>
            </table></div>";



        
    }

   

}

?>