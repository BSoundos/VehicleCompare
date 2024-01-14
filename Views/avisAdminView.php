<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');


class AvisAdminView {

    private $acceuil_controller ;
    private $admin_controller ;
    private $vehicule_controller;
    private $avisController;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->avisController = new avisController();
    }

    public function avisDisplay(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();


        $this->displayTable();


        
        //$this->acceuil_controller->footer();

        echo "</div></body></html>";
    }


    public function displayTable(){

        // only the vehicules 
        $r = $this->avisController->get_avis_vehicule_controller(); 
        $r = $r->fetchAll(PDO::FETCH_ASSOC);



        // the table 
       echo "
       <div class='table-admin'>
            <table>
            <thead>
                <tr>
                    <th>Utilisateur ID</th>
                    <th>Cible ID</th>
                    <th>Commentaire</th>
                    <th>Statut</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>";

            foreach($r as $row){

                
                // $user_id = $row['utilisateur_id'] then get its username ?
               
            
                echo"
                    <tr>
                        <td>".$row['utilisateur_id']."</td>
                        <td>".$row['target_id']."</td>
                        <td>".$row['commentaire']."</td>
                        <td>".$row['statut']."</td>
                        <td> 
                        <a href='index.php' >Refuser commentaire</a>
                        <a href='index.php' >Bloque utilisateur</a>
                        </td>
                
                    </tr>";

            }
                
            echo"
            </tbody>
            </table></div>";


        
    }

   

}

?>