<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');

class adminView {

    private $acceuil_controller ;
    private $admin_controller ;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
    }

    public function pagePrincipalDisplay(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->manageLinks();
        

        echo "</div></body></html>";
    }


    // Afficher les 5 images avec les liens pour les taches de gestions 
    public function manageLinks(){

        echo"<div class='manage-links'>";

        $r = $this->admin_controller->get_images_controller();
        $r = $r->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($r as $row){
            echo  '<a href="index.php?action=admin&page='.$row["nom"].'"><img src='.$row["lien"].' ></a>';
        }

        echo"</div>";

    }


    // Pour les fonctions de triages et de recherche
    public function jQueryForTables(){
        echo "
            <script>
                $(document).ready(function () {
                    
                    $('#myTable').DataTable();

                    
                });
            </script>
            ";
    }


}

?>